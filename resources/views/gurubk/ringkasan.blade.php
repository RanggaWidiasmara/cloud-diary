@extends('layouts.gurubk')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Analitik Emosi Mendalam</h1>
        <p class="text-sm text-slate-500 mt-1">Laporan detail untuk evaluasi konseling dan pelaporan sekolah.</p>
    </div>
    
    <!-- Filter Waktu & Tombol Ekspor -->
    <div class="flex flex-wrap gap-3">
        <div class="flex items-center bg-white border border-slate-200 rounded-lg shadow-sm px-3 py-1.5">
            <span class="text-slate-400 text-sm mr-2">📅</span>
            <input type="date" class="text-sm text-slate-600 outline-none bg-transparent">
            <span class="mx-2 text-slate-300">-</span>
            <input type="date" class="text-sm text-slate-600 outline-none bg-transparent">
        </div>
        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2 px-4 rounded-lg transition shadow-sm flex items-center gap-2 text-sm">
            <span>⬇️</span> Ekspor Laporan (PDF)
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    
    <!-- 1. Peta Kata Kunci (Word Cloud AI) -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm col-span-1 flex flex-col">
        <div class="flex items-center gap-2 mb-4">
            <span class="text-sky-500">✨</span>
            <h3 class="font-bold text-slate-800">Peta Kata Kunci AI</h3>
        </div>
        <p class="text-xs text-slate-500 mb-4">Kata yang paling sering muncul di jurnal bersentimen "Mendung" & "Hujan".</p>
        
        <div class="flex-1 flex flex-wrap content-center justify-center gap-3 text-center p-4 bg-slate-50 rounded-xl border border-slate-100">
            <span class="text-3xl font-bold text-red-500">Tugas</span>
            <span class="text-xl font-semibold text-orange-400">Ulangan</span>
            <span class="text-lg text-slate-600">Teman</span>
            <span class="text-2xl font-bold text-red-400">Keluarga</span>
            <span class="text-sm text-slate-500">Ekskul</span>
            <span class="text-xl font-medium text-orange-500">Matematika</span>
            <span class="text-base text-slate-600">Capek</span>
            <span class="text-sm text-slate-400">Begadang</span>
        </div>
    </div>

    <!-- 2. Komparasi Antar Angkatan -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm col-span-2">
        <h3 class="font-bold text-slate-800 mb-4">Komparasi Stres Antar Angkatan</h3>
        <div class="relative h-64 w-full">
            <canvas id="komparasiAngkatanChart"></canvas>
        </div>
    </div>

</div>

<!-- 3. Analisis Waktu (Heatmap) -->
<div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <h3 class="font-bold text-slate-800 mb-1">Peta Waktu Emosi (Heatmap)</h3>
    <p class="text-xs text-slate-500 mb-4">Mendeteksi waktu banyaknya siswa paling sering melaporkan emosi.</p>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-center">
            <thead class="text-slate-500">
                <tr>
                    <th class="py-2 text-left w-24">Hari</th>
                    <th class="py-2">Pagi (06:00 - 10:00)</th>
                    <th class="py-2">Siang (10:00 - 14:00)</th>
                    <th class="py-2">Sore (14:00 - 18:00)</th>
                    <th class="py-2">Malam (18:00 - 22:00)</th>
                </tr>
            </thead>
            <tbody class="text-slate-700 font-medium space-y-1">
                <tr>
                    <td class="py-3 text-left font-semibold text-slate-600">Senin</td>
                    <td class="bg-red-100 text-red-700 rounded-l-lg border-2 border-white">Banyak Hujan</td>
                    <td class="bg-orange-100 text-orange-700 border-2 border-white">Mendung</td>
                    <td class="bg-yellow-100 text-yellow-700 border-2 border-white">Cerah</td>
                    <td class="bg-orange-100 text-orange-700 rounded-r-lg border-2 border-white">Mendung</td>
                </tr>
                <tr>
                    <td class="py-3 text-left font-semibold text-slate-600">Selasa</td>
                    <td class="bg-yellow-100 text-yellow-700 rounded-l-lg border-2 border-white">Cerah</td>
                    <td class="bg-yellow-100 text-yellow-700 border-2 border-white">Cerah</td>
                    <td class="bg-orange-100 text-orange-700 border-2 border-white">Mendung</td>
                    <td class="bg-slate-100 text-slate-500 rounded-r-lg border-2 border-white">Sepi Jurnal</td>
                </tr>
                <tr>
                    <td class="py-3 text-left font-semibold text-slate-600">Rabu</td>
                    <td class="bg-yellow-100 text-yellow-700 rounded-l-lg border-2 border-white">Cerah</td>
                    <td class="bg-red-100 text-red-700 border-2 border-white">Banyak Hujan</td>
                    <td class="bg-red-100 text-red-700 border-2 border-white">Banyak Hujan</td>
                    <td class="bg-orange-100 text-orange-700 rounded-r-lg border-2 border-white">Mendung</td>
                </tr>
                <tr>
                    <td class="py-3 text-left font-semibold text-slate-600">Kamis</td>
                    <td class="bg-orange-100 text-orange-700 rounded-l-lg border-2 border-white">Mendung</td>
                    <td class="bg-yellow-100 text-yellow-700 border-2 border-white">Cerah</td>
                    <td class="bg-yellow-100 text-yellow-700 border-2 border-white">Cerah</td>
                    <td class="bg-yellow-100 text-yellow-700 rounded-r-lg border-2 border-white">Cerah</td>
                </tr>
                <tr>
                    <td class="py-3 text-left font-semibold text-slate-600">Jumat</td>
                    <td class="bg-yellow-100 text-yellow-700 rounded-l-lg border-2 border-white">Cerah</td>
                    <td class="bg-yellow-100 text-yellow-700 border-2 border-white">Cerah</td>
                    <td class="bg-green-100 text-green-700 border-2 border-white">Sangat Cerah</td>
                    <td class="bg-green-100 text-green-700 rounded-r-lg border-2 border-white">Sangat Cerah</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxKomparasi = document.getElementById('komparasiAngkatanChart').getContext('2d');
        new Chart(ctxKomparasi, {
            type: 'bar',
            data: {
                labels: ['Kelas 10 (Siswa Baru)', 'Kelas 11 (Pertengahan)', 'Kelas 12 (Persiapan Lulus)'],
                datasets: [
                    { label: 'Indikasi Depresi (Hujan)', data: [15, 25, 45], backgroundColor: 'rgba(239, 68, 68, 0.8)', borderRadius: 4 },
                    { label: 'Kelelahan (Mendung)', data: [40, 50, 35], backgroundColor: 'rgba(249, 115, 22, 0.8)', borderRadius: 4 },
                    { label: 'Stabil (Cerah)', data: [65, 45, 30], backgroundColor: 'rgba(250, 204, 21, 0.8)', borderRadius: 4 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true, max: 100, ticks: { callback: function(value) { return value + "%" } } } }
            }
        });
    });
</script>
@endsection