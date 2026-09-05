@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Riwayat Tindakan</h1>
        <p class="text-sm text-slate-500 mt-1">Catatan tindak lanjut yang telah dilakukan oleh Guru BK terhadap siswa.</p>
    </div>
    
    <!-- Filter dan Pencarian -->
    <div class="flex gap-3">
        <input type="date" class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 shadow-sm">
        <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 bg-white shadow-sm">
            <option>Semua Status</option>
            <option>Selesai</option>
            <option>Dalam Pantauan</option>
        </select>
    </div>
</div>

<!-- Timeline Riwayat -->
<div class="max-w-4xl">
    <div class="relative border-l-2 border-slate-200 ml-4 space-y-8 pb-4">
        
        <!-- Item 1 -->
        <div class="relative pl-8">
            <!-- Dot Timeline -->
            <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-sky-500 border-4 border-white shadow-sm"></div>
            
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm transition hover:shadow-md">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Hari ini, 10:30 WIB</span>
                        <h3 class="font-bold text-slate-800 text-lg mt-1">Sesi Konseling Individu: Aulia Putri (9A)</h3>
                    </div>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-slate-600"><span class="font-semibold">Pemicu dari AI:</span> Terdeteksi tren emosi menurun selama 3 hari terakhir, prioritas tinggi.</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="text-sky-500">📝</span> Catatan Tindak Lanjut Guru BK
                    </h4>
                    <p class="text-sm text-slate-600 italic">"Telah dilakukan pendekatan personal. Aulia menceritakan kesulitan komunikasi dengan teman kelompoknya. Sudah diberikan saran mediasi dan teknik relaksasi ringan. Emosi siswa tampak lebih stabil di akhir sesi."</p>
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="relative pl-8">
            <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-orange-400 border-4 border-white shadow-sm"></div>
            
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm transition hover:shadow-md">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kemarin, 13:15 WIB</span>
                        <h3 class="font-bold text-slate-800 text-lg mt-1">Pemanggilan Singkat: Rizky Ramadhan (10B)</h3>
                    </div>
                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold">Dalam Pantauan</span>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-slate-600"><span class="font-semibold">Pemicu dari AI:</span> Tren emosi stabil mendung, indikasi kelelahan mental ringan.</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="text-sky-500">📝</span> Catatan Tindak Lanjut Guru BK
                    </h4>
                    <p class="text-sm text-slate-600 italic">"Rizky dipanggil sebentar ke ruang BK. Ia mengaku kurang tidur karena persiapan lomba. Sudah saya berikan motivasi dan kelonggaran jadwal konsultasi. Akan terus dipantau grafiknya minggu ini."</p>
                </div>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="relative pl-8">
            <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-slate-300 border-4 border-white shadow-sm"></div>
            
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm transition hover:shadow-md">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">10 September 2026, 09:00 WIB</span>
                        <h3 class="font-bold text-slate-800 text-lg mt-1">Penyuluhan Klasikal (Kelas 12A)</h3>
                    </div>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-slate-600"><span class="font-semibold">Pemicu dari AI:</span> Notifikasi kritis agregat - banyak siswa kelas 12A dengan emosi 'hujan' dalam waktu singkat.</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 flex items-center gap-2">
                        <span class="text-sky-500">📝</span> Catatan Tindak Lanjut Guru BK
                    </h4>
                    <p class="text-sm text-slate-600 italic">"Mengadakan sesi bimbingan klasikal tentang 'Manajemen Stres Ujian'. Mayoritas keluhan terkait penumpukan tugas. Sudah dikoordinasikan dengan wali kelas terkait beban tugas."</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection