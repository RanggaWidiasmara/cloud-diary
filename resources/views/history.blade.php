@extends('layouts.app')

@section('content')
<div class="p-8 max-w-4xl mx-auto h-full flex flex-col">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-700">Riwayat Perjalananmu</h1>
        <p class="text-slate-500 mt-2">Lihat kembali awan-awan emosi yang sudah kamu lewati.</p>
    </div>

    <!-- Sistem Tab -->
    <div class="flex border-b border-slate-200 mb-6">
        <button id="btn-harian" class="tab-btn px-6 py-3 font-semibold text-sky-600 border-b-2 border-sky-500 focus:outline-none transition-colors">
            Log Harian
        </button>
        <button id="btn-mingguan" class="tab-btn px-6 py-3 font-semibold text-slate-400 hover:text-slate-600 focus:outline-none transition-colors border-b-2 border-transparent">
            Rangkuman Mingguan
        </button>
    </div>

    <!-- KONTEN: LOG HARIAN (Kalender) -->
    <div id="konten-harian" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8">

        <!-- Header Kalender -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-slate-700">Agustus 2026</h3>
            <div class="flex gap-2">
                <button class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-600">&larr;</button>
                <button class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-600">&rarr;</button>
            </div>
        </div>

        <!-- CSS Grid Kalender -->
        <div class="grid grid-cols-7 gap-2 md:gap-4 text-center">
            <!-- Nama Hari -->
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Sen</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Sel</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Rab</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Kam</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Jum</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Sab</div>
            <div class="text-xs font-bold text-slate-400 uppercase pb-2">Min</div>

            <!-- Tanggal Kosong (Bulan Lalu) -->
            <div></div><div></div><div></div><div></div><div></div>

            <!-- Contoh Tanggal 1 (Kosong) -->
            <div class="aspect-square flex flex-col items-center justify-center rounded-2xl border border-transparent text-slate-400">
                <span class="font-medium text-sm">1</span>
            </div>

            <!-- Contoh Tanggal 2 (Ada Curhatan Sedih) -->
            <div class="aspect-square flex flex-col items-center justify-center bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer hover:shadow-md transition group relative">
                <span class="font-bold text-sm text-slate-600">2</span>
                <span class="text-2xl mt-1 group-hover:scale-110 transition-transform">🌧️</span>
            </div>

            <!-- Contoh Tanggal 3 (Ada Curhatan Senang) -->
            <div class="aspect-square flex flex-col items-center justify-center bg-sky-50 rounded-2xl border border-sky-200 cursor-pointer hover:shadow-md transition group relative">
                <span class="font-bold text-sm text-sky-700">3</span>
                <span class="text-2xl mt-1 group-hover:scale-110 transition-transform">☀️</span>
            </div>

            <!-- Contoh Tanggal 4 (Hari Ini - Belum Curhat) -->
            <div class="aspect-square flex flex-col items-center justify-center border-2 border-dashed border-sky-300 rounded-2xl bg-white text-sky-500 font-bold">
                <span class="text-sm">4</span>
            </div>

            <!-- (Sisa tanggal abaikan dulu, ini cuma dummy UI) -->
        </div>
    </div>

    <!-- KONTEN: RANGKUMAN MINGGUAN (List Cards) -->
    <div id="konten-mingguan" class="tab-content hidden flex-col gap-6">

        <!-- Kartu Minggu 1 -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 flex gap-6 items-center">
            <div class="w-24 h-24 bg-sky-50 rounded-2xl flex items-center justify-center text-4xl shrink-0">
                ☀️
            </div>
            <div>
                <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Minggu, 27 Jul - 2 Agt 2026</h4>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Dominan: Cerah & Senang</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    "Minggu ini kamu terlihat sangat bersemangat! Banyak hal positif yang kamu alami, terutama saat menyelesaikan project penting. Tetap pertahankan energi ini!"
                </p>
            </div>
        </div>

        <!-- Kartu Minggu Sebelumnya (Dummy) -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 flex gap-6 items-center">
            <div class="w-24 h-24 bg-slate-50 rounded-2xl flex items-center justify-center text-4xl shrink-0">
                🌧️
            </div>
            <div>
                <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Minggu, 20 Jul - 26 Jul 2026</h4>
                <h3 class="text-xl font-bold text-slate-700 mb-2">Dominan: Hujan & Lelah</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    "Minggu lalu terasa cukup berat dengan banyaknya tekanan pekerjaan. Tidak apa-apa untuk merasa lelah, ingatlah untuk selalu mengambil jeda istirahat."
                </p>
            </div>
        </div>

    </div>

</div>

<!-- Logic Javascript Simple buat Switch Tab -->
<script>
    const btnHarian = document.getElementById('btn-harian');
    const btnMingguan = document.getElementById('btn-mingguan');
    const kontenHarian = document.getElementById('konten-harian');
    const kontenMingguan = document.getElementById('konten-mingguan');

    btnHarian.addEventListener('click', () => {
        // Aktifkan tombol harian
        btnHarian.classList.add('text-sky-600', 'border-sky-500');
        btnHarian.classList.remove('text-slate-400', 'border-transparent');
        // Nonaktifkan tombol mingguan
        btnMingguan.classList.remove('text-sky-600', 'border-sky-500');
        btnMingguan.classList.add('text-slate-400', 'border-transparent');
        // Tampilkan konten
        kontenHarian.classList.remove('hidden');
        kontenMingguan.classList.add('hidden');
        kontenMingguan.classList.remove('flex');
    });

    btnMingguan.addEventListener('click', () => {
        // Aktifkan tombol mingguan
        btnMingguan.classList.add('text-sky-600', 'border-sky-500');
        btnMingguan.classList.remove('text-slate-400', 'border-transparent');
        // Nonaktifkan tombol harian
        btnHarian.classList.remove('text-sky-600', 'border-sky-500');
        btnHarian.classList.add('text-slate-400', 'border-transparent');
        // Tampilkan konten
        kontenMingguan.classList.remove('hidden');
        kontenMingguan.classList.add('flex');
        kontenHarian.classList.add('hidden');
    });
</script>
@endsection
