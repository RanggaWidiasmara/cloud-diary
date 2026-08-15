<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\DiaryEntry;

class DiaryController extends Controller
{
    public function store(Request $request)
    {
        // 1. CEK GUEST LIMIT: Kalau belum login dan udah pernah nyoba, lempar ke Register
        if (!Auth::check() && session()->has('has_tried_guest')) {
            return redirect()->route('register')->with('warning', 'Jatah coba gratis habis nih. Yuk daftar buat lanjut curhat dan simpan riwayat awanmu!');
        }

        // 2. Validasi + Batas Karakter
        $request->validate([
            'content' => 'required|string|max:1000',
        ], [
            'content.max' => 'Curhatannya kepanjangan, Bro! Maksimal 1000 karakter ya biar awannya nggak keberatan.'
        ]);

        $curhatan = $request->input('content');

        // 3. Prompt Engineering JSON (Sama kayak sebelumnya)
        $prompt = "Kamu adalah psikolog dan sistem analisis emosi. Baca curhatan berikut dan berikan analisis emosi utama beserta saran suportif.
        WAJIB merespon HANYA dengan format JSON murni persis seperti struktur di bawah ini, tanpa awalan atau akhiran markdown.

        {
            \"cloud_type\": \"pilih salah satu: cerah, hujan, badai, mendung, atau cinta\",
            \"ai_suggestion\": \"Kalimat saran dan motivasi singkat maksimal 2 kalimat yang menenangkan.\"
        }

        Panduan pilihan cloud_type:
        - 'cerah' (positif, senang, bersyukur)
        - 'hujan' (sedih, kecewa, menangis)
        - 'badai' (marah, kesal, emosi tinggi)
        - 'mendung' (lelah, bingung, khawatir)
        - 'cinta' (romantis, jatuh cinta, kasih sayang)

        Curhatan: \"" . $curhatan . "\"";

        $apiKey = config('services.gemini.key');
        $url = 'https://generativelanguage.googleapis.com/v1beta/interactions';

        try {
            $response = Http::timeout(15)->withHeaders([
                'x-goog-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'model' => 'gemini-3.6-flash',
                'input' => $prompt
            ]);

            // TANGKAP ERROR 429 (Kena Limit Antrean)
            if ($response->status() === 429) {
                return back()->with('error', 'Waduh, awannya lagi penuh antrean nih. Tunggu sekitar 1 menit lalu coba ceritain lagi ya!');
            }

            if ($response->successful()) {
                $result = $response->json();
                $aiResponseText = '';

                if (isset($result['steps'])) {
                    foreach ($result['steps'] as $step) {
                        if (isset($step['type']) && $step['type'] === 'model_output') {
                            if (isset($step['content'][0]['text'])) {
                                $aiResponseText = $step['content'][0]['text'];
                                break;
                            }
                        }
                    }
                }

                $cleanJson = str_replace(['```json', '```'], '', $aiResponseText);
                $parsedData = json_decode(trim($cleanJson), true);

                $awan = 'cerah';
                $saran = 'Terima kasih sudah bercerita. Tetap semangat dan jalani hari dengan hal positif!';

                if (is_array($parsedData)) {
                    $awan = trim(strtolower($parsedData['cloud_type'] ?? 'cerah'));
                    $saran = $parsedData['ai_suggestion'] ?? $saran;
                }

                $validAwan = ['cerah', 'hujan', 'badai', 'mendung', 'cinta'];
                if (!in_array($awan, $validAwan)) {
                    $awan = 'cerah';
                }

                // 4. LOGIKA PEMISAHAN USER DAN GUEST
                if (Auth::check()) {
                    // Kalau User: Simpan ke Database
                    DiaryEntry::create([
                        'user_id' => Auth::id(),
                        'content' => $curhatan,
                        'cloud_type' => $awan,
                        'ai_suggestion' => $saran,
                    ]);
                } else {
                    // Kalau Guest: Simpan ke Session aja dan tandai dia udah nyoba
                    session([
                        'has_tried_guest' => true,
                        // Kita simpan datanya di session buat di-transfer pas dia register nanti (Bonus UX)
                        'pending_guest_curhatan' => $curhatan,
                        'pending_guest_awan' => $awan,
                        'pending_guest_saran' => $saran,
                    ]);
                }

                return back()
                    ->with('success', 'Awan emosimu hari ini: ' . strtoupper($awan))
                    ->with('awan', $awan)
                    ->with('saran', $saran);
            }

            return back()->with('error', 'Waduh, awannya lagi mendung banget nih, server AI lagi pusing. Coba lagi bentar ya!');

        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi ke awan terputus. Pastikan internetmu stabil dan coba lagi.');
        }
    }
}
