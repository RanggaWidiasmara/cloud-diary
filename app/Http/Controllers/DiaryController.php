<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\DiaryEntry;
use Carbon\Carbon;

class DiaryController extends Controller
{
    // --- 1. FUNGSI UNTUK MENYIMPAN CURHATAN ---
    public function store(Request $request)
    {
        // CEK GUEST LIMIT
        if (!Auth::check() && session()->has('has_tried_guest')) {
            return redirect()->route('register')->with('warning', 'Jatah coba gratis habis nih. Yuk daftar buat lanjut curhat dan simpan riwayat awanmu!');
        }

        // CEK BATAS MAKSIMAL 3x SEHARI (Khusus User Login)
        if (Auth::check()) {
            $todayCount = \App\Models\DiaryEntry::where('user_id', Auth::id())
                                    ->whereDate('created_at', \Carbon\Carbon::today())
                                    ->count();

            if ($todayCount >= 3) {
                return back()->with('error', 'Wah, batas curhat harianmu (3x) sudah penuh. Biarkan awannya istirahat dulu ya, besok kita cerita lagi! ☁️💤');
            }
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ], [
            'content.max' => 'Curhatannya kepanjangan, Bro! Maksimal 1000 karakter ya biar awannya nggak keberatan.'
        ]);

        $curhatan = $request->input('content');

        // --- MULAI FILTER TEKS NGAWUR DI SINI ---
        $teksLower = strtolower(trim($curhatan));

        // Pecah kalimat jadi array kata-kata
        $kataArray = str_word_count($teksLower, 1);
        $kataUnik = array_unique($kataArray); // Ngambil kata yang nggak kembar

        // 1. Cek Minimal Kata
        if (count($kataArray) < 4) {
            return back()->with('error', 'Awan butuh cerita yang lebih panjang nih (minimal 4 kata). Yuk, ceritain lebih detail!');
        }

        // 2. Cek Karakter Berulang (Mencegah "aaaaa" atau "wkwkwkwk" tanpa spasi)
        if (preg_match('/(.)\1{4,}/', $teksLower)) {
            return back()->with('error', 'Ketikanmu sepertinya kurang jelas. Coba pakai bahasa yang biasa ya!');
        }

        // 3. Cek Repetisi Kata (Mencegah "wkwk wkwk wkwk wkwk")
        // Kalau ngetik 4 kata atau lebih, tapi isi kata bedanya (unik) cuma 1 atau 2, fix nyepam!
        if (count($kataUnik) < 3) {
            return back()->with('error', 'Ceritanya kok diulang-ulang kata yang sama? Tulis kalimat yang bermakna yuk!');
        }

        // 4. Blacklist Kata Ngawur (Cek per kata)
        $blacklist = ['hilih', 'tes', 'test', 'halo', 'hai', 'wkwk', 'wkwkwk', 'awok'];

        // Jika SEMUA kata yang diketik ternyata ada di dalam blacklist
        if (count(array_diff($kataArray, $blacklist)) === 0) {
            return back()->with('error', 'Hmm, sepertinya itu bukan curhatan. Yuk tulis perasaanmu yang sebenarnya!');
        }
        // --- BATAS FILTER TEKS NGAWUR ---

        // Prompt Gemini
        $prompt = "Kamu adalah psikolog dan sistem analisis emosi. Baca curhatan berikut dan berikan analisis emosi utama beserta saran suportif.
        WAJIB merespon HANYA dengan format JSON murni persis seperti struktur di bawah ini, tanpa awalan atau akhiran markdown.

        {
            \"cloud_type\": \"pilih salah satu: cerah, hujan, badai, mendung, atau cinta\",
            \"ai_suggestion\": \"Kalimat saran dan motivasi singkat maksimal 2 kalimat yang menenangkan.\"
        }

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

                if (Auth::check()) {
                    \App\Models\DiaryEntry::create([
                        'user_id' => Auth::id(),
                        'content' => $curhatan,
                        'cloud_type' => $awan,
                        'ai_suggestion' => $saran,
                    ]);
                } else {
                    session([
                        'has_tried_guest' => true,
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

    // --- 2. FUNGSI UNTUK MENAMPILKAN KALENDER RIWAYAT ---
    public function history(Request $request)
    {
        $month = $request->input('month', \Carbon\Carbon::now()->month);
        $year = $request->input('year', \Carbon\Carbon::now()->year);

        $date = \Carbon\Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;
        $firstDayOfWeek = $date->copy()->startOfMonth()->isoWeekday();

        $entries = \App\Models\DiaryEntry::where('user_id', Auth::id())
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mengelompokkan data berdasarkan tanggal (1 hari bisa isi 1, 2, atau 3 data)
        $entriesByDay = [];
        foreach ($entries as $entry) {
            $day = (int) $entry->created_at->format('j');
            if (!isset($entriesByDay[$day])) {
                $entriesByDay[$day] = [];
            }
            $entriesByDay[$day][] = $entry;
        }

        return view('history', compact('entriesByDay', 'daysInMonth', 'firstDayOfWeek', 'date'));
    }
}
