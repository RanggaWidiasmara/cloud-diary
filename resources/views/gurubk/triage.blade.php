@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Triage & Rekomendasi AI</h1>
        <p class="text-sm text-slate-500 mt-1">Saran pendekatan dari AI berdasarkan analisis emosi tanpa menampilkan teks curhatan asli siswa.</p>
    </div>
    
    <!-- Filter Prioritas -->
    <div class="flex gap-3">
        <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 bg-white shadow-sm">
            <option>Semua Prioritas</option>
            <option>🔴 Prioritas Tinggi</option>
            <option>🟠 Prioritas Menengah</option>
        </select>
    </div>
</div>

<!-- Daftar Kartu Triage -->
<div class="space-y-4">
    
    <!-- Kartu 1 (Prioritas Tinggi - Merah) -->
    <div class="bg-white rounded-2xl border-l-4 border-red-500 shadow-sm p-6 flex flex-col md:flex-row gap-6 items-start md:items-center relative overflow-hidden transition hover:shadow-md">
        
        <!-- Label Sudut -->
        <div class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wider">
            Prioritas Tinggi
        </div>

        <!-- Info Siswa -->
        <div class="w-full md:w-1/4">
            <h3 class="font-bold text-slate-800 text-lg">Aulia Putri</h3>
            <p class="text-slate-500 text-sm">Kelas 9A</p>
            <div class="mt-2 flex items-center gap-2 text-sm">
                <span class="text-red-500 font-semibold">📉 Tren Menurun</span>
                <span class="text-slate-400 text-xs">(3 hari hujan)</span>
            </div>
        </div>

        <!-- Analisis AI -->
        <div class="w-full md:w-2/4 bg-slate-50 p-4 rounded-xl border border-slate-100 relative">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-sky-500">✨</span>
                <span class="font-bold text-slate-700 text-xs uppercase tracking-wider">Analisis AI</span>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed">Siswa menunjukkan pola emosi negatif berturut-turut. Kemungkinan mengalami tekanan sosial atau akademik. Pendekatan empatik disarankan, ajak bicara personal di luar jam pelajaran secara santai.</p>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full md:w-1/4 flex flex-col gap-2 mt-4 md:mt-0">
            <button class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2.5 px-4 rounded-xl transition text-sm shadow-sm">
                Tandai Ditangani
            </button>
            <button class="w-full bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-600 font-medium py-2.5 px-4 rounded-xl transition text-sm">
                Lihat Grafik Emosi
            </button>
        </div>
    </div>

    <!-- Kartu 2 (Prioritas Menengah - Oranye) -->
    <div class="bg-white rounded-2xl border-l-4 border-orange-400 shadow-sm p-6 flex flex-col md:flex-row gap-6 items-start md:items-center relative overflow-hidden transition hover:shadow-md">
        
        <div class="w-full md:w-1/4">
            <h3 class="font-bold text-slate-800 text-lg">Rizky Ramadhan</h3>
            <p class="text-slate-500 text-sm">Kelas 10B</p>
            <div class="mt-2 flex items-center gap-2 text-sm">
                <span class="text-orange-500 font-semibold">〰️ Stabil Mendung</span>
                <span class="text-slate-400 text-xs">(Pola pasif)</span>
            </div>
        </div>

        <div class="w-full md:w-2/4 bg-slate-50 p-4 rounded-xl border border-slate-100 relative">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-sky-500">✨</span>
                <span class="font-bold text-slate-700 text-xs uppercase tracking-wider">Analisis AI</span>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed">Terdeteksi kelelahan mental ringan yang konstan. Berikan dukungan moral, fokus pada manajemen stres akademik. Bisa diselipkan materi tentang self-care di bimbingan kelas berikutnya.</p>
        </div>

        <div class="w-full md:w-1/4 flex flex-col gap-2 mt-4 md:mt-0">
            <button class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2.5 px-4 rounded-xl transition text-sm shadow-sm">
                Tandai Ditangani
            </button>
            <button class="w-full bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-600 font-medium py-2.5 px-4 rounded-xl transition text-sm">
                Lihat Grafik Emosi
            </button>
        </div>
    </div>

    <!-- Kartu 3 (Prioritas Rendah - Kuning/Cerah) -->
    <div class="bg-white rounded-2xl border-l-4 border-yellow-400 shadow-sm p-6 flex flex-col md:flex-row gap-6 items-start md:items-center relative overflow-hidden transition hover:shadow-md opacity-70">
        
        <div class="w-full md:w-1/4">
            <h3 class="font-bold text-slate-800 text-lg">Dinda Ayu</h3>
            <p class="text-slate-500 text-sm">Kelas 8A</p>
            <div class="mt-2 flex items-center gap-2 text-sm">
                <span class="text-yellow-500 font-semibold">☀️ Mayoritas Cerah</span>
            </div>
        </div>

        <div class="w-full md:w-2/4 bg-slate-50 p-4 rounded-xl border border-slate-100 relative">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-sky-500">✨</span>
                <span class="font-bold text-slate-700 text-xs uppercase tracking-wider">Analisis AI</span>
            </div>
            <p class="text-sm text-slate-600 leading-relaxed">Kondisi emosi sangat positif dan stabil. Tidak ada indikasi stres atau masalah yang memerlukan intervensi saat ini. Terus pantau aktivitas mingguannya.</p>
        </div>

        <div class="w-full md:w-1/4 flex flex-col gap-2 mt-4 md:mt-0">
            <button class="w-full bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-600 font-medium py-2.5 px-4 rounded-xl transition text-sm" disabled>
                Tidak Ada Tindakan
            </button>
        </div>
    </div>

</div>
@endsection