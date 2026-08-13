<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\DiaryEntry; // INI UDAH DIAKTIFIN

class DiaryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $curhatan = $request->input('content');

        $prompt = "Kamu adalah sistem analisis emosi. Tugasmu membaca teks curhatan berikut dan tentukan emosi dominannya.
        Pilih SATU KATA SAJA dari daftar ini tanpa tanda baca tambahan:
        - 'cerah' (jika teks bernada positif, senang, bersyukur)
        - 'hujan' (jika teks bernada sedih, kecewa, menangis)
        - 'badai' (jika teks bernada marah, kesal, emosi tinggi)
        - 'mendung' (jika teks bernada lelah, bingung, khawatir)
        - 'cinta' (jika teks bernada romantis, jatuh cinta, kasih sayang)

        Curhatan: \"" . $curhatan . "\"";

        $apiKey = config('services.gemini.key');

        // URL Baru sesuai dokumentasi Interactions API
        $url = 'https://generativelanguage.googleapis.com/v1beta/interactions';

        // Tembak API dengan struktur baru
        $response = Http::withHeaders([
            'x-goog-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'model' => 'gemini-3.6-flash',
            'input' => $prompt
        ]);

        if ($response->successful()) {
            $result = $response->json();

            // Logic baru buat ngekstrak teks balasan dari array 'steps'
            $aiResponse = 'cerah'; // Fallback default
            if (isset($result['steps'])) {
                foreach ($result['steps'] as $step) {
                    if (isset($step['type']) && $step['type'] === 'model_output') {
                        if (isset($step['content'][0]['text'])) {
                            $aiResponse = $step['content'][0]['text'];
                            break;
                        }
                    }
                }
            }

            $awan = trim(strtolower($aiResponse));

            $validAwan = ['cerah', 'hujan', 'badai', 'mendung', 'cinta'];
            if (!in_array($awan, $validAwan)) {
                $awan = 'cerah';
            }

            // Simpan ke Database
            DiaryEntry::create([
                'user_id' => Auth::id(),
                'content' => $curhatan,
                'cloud_type' => $awan,
            ]);

            return back()
                ->with('success', 'Awan emosimu hari ini: ' . strtoupper($awan))
                ->with('awan', $awan);
        }

        // Kalau masih error, balikin pesan ini
        return back()->with('error', 'Gagal menghubungi server awan. Coba lagi nanti.');
    }
}
