@extends('layouts.gurubk')

@section('content')
<h1 class="text-2xl font-bold text-slate-800 mb-6">Dashboard Utama</h1>

<!-- 1. KOTAK ANGKA STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between transition hover:shadow-md">
        <div><div class="text-slate-500 text-sm mb-1">Cerah</div><div class="text-2xl font-bold text-slate-800">45%</div><div class="text-xs text-green-500 mt-1">↑ 5% dari kemarin</div></div><div class="text-4xl">☀️</div>
    </div>
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between transition hover:shadow-md">
        <div><div class="text-slate-500 text-sm mb-1">Mendung</div><div class="text-2xl font-bold text-slate-800">35%</div><div class="text-xs text-red-500 mt-1">↓ 3% dari kemarin</div></div><div class="text-4xl">☁️</div>
    </div>
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between transition hover:shadow-md">
        <div><div class="text-slate-500 text-sm mb-1">Hujan</div><div class="text-2xl font-bold text-slate-800">20%</div><div class="text-xs text-green-500 mt-1">↑ 2% dari kemarin</div></div><div class="text-4xl">🌧️</div>
    </div>
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between transition hover:shadow-md">
        <div><div class="text-slate-500 text-sm mb-1">Total Siswa Aktif</div><div class="text-2xl font-bold text-slate-800">1.234</div><div class="text-xs text-slate-400 mt-1">dari 1.560 siswa</div></div><div class="text-4xl">👥</div>
    </div>
</div>

<!-- 2. GRAFIK RINGKASAN EMOSI (Pindahan) -->
<h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Tren & Distribusi Emosi</h2>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-slate-800">Tren 7 Hari Terakhir</h3>
        </div>
        <div class="relative h-64 w-full">
            <canvas id="trenEmosiChart"></canvas>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="font-bold text-slate-800 mb-4">Distribusi per Kelas (Hari Ini)</h3>
        <div class="relative h-64 w-full">
            <canvas id="distribusiKelasChart"></canvas>
        </div>
    </div>
</div>

<!-- 3. TABEL TRIAGE & AKTIVITAS -->
<h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Pemantauan Khusus</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm col-span-2 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200"><h3 class="font-bold text-slate-800">Siswa Perhatian Khusus (Triage)</h3></div>
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr><th class="px-6 py-3">Nama Siswa</th><th class="px-6 py-3">Kelas</th><th class="px-6 py-3">Tren</th><th class="px-6 py-3">Rekomendasi (AI)</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <tr class="hover:bg-slate-50 transition"><td class="px-6 py-4 font-medium text-slate-800">Aulia Putri</td><td class="px-6 py-4">9A</td><td class="px-6 py-4 text-red-500 font-semibold">📉 Menurun</td><td class="px-6 py-4 text-slate-600 text-xs">Pendekatan empatik segera...</td></tr>
                <tr class="hover:bg-slate-50 transition"><td class="px-6 py-4 font-medium text-slate-800">Rizky Ramadhan</td><td class="px-6 py-4">10B</td><td class="px-6 py-4 text-orange-500 font-semibold">〰️ Stabil</td><td class="px-6 py-4 text-slate-600 text-xs">Berikan dukungan moral...</td></tr>
            </tbody>
        </table>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h3 class="font-bold text-slate-800 mb-4">Aktivitas Terbaru</h3>
        <div class="space-y-4">
            <div class="flex gap-3 text-sm"><span class="text-sky-500 mt-0.5">📝</span><div><p class="text-slate-600">3 siswa <span class="font-bold text-slate-800">Kelas 7B</span> menulis jurnal</p><span class="text-xs text-slate-400">Baru saja</span></div></div>
            <div class="flex gap-3 text-sm"><span class="text-red-500 mt-0.5">⚠️</span><div><p class="text-slate-600">Peringatan prioritas <span class="font-bold text-slate-800">Aulia Putri</span></p><span class="text-xs text-slate-400">15 menit yang lalu</span></div></div>
        </div>
    </div>
</div>

<!-- SCRIPT GRAFIK -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorCerah = 'rgba(250, 204, 21, 0.8)';
        const colorMendung = 'rgba(148, 163, 184, 0.8)';
        const colorHujan = 'rgba(99, 102, 241, 0.8)';

        const ctxTren = document.getElementById('trenEmosiChart').getContext('2d');
        new Chart(ctxTren, {
            type: 'line',
            data: {
                labels: ['7/9', '8/9', '9/9', '10/9', '11/9', '12/9', '13/9'],
                datasets: [
                    { label: 'Cerah', data: [20, 40, 30, 35, 55, 45, 50], borderColor: colorCerah, backgroundColor: colorCerah, tension: 0.3 },
                    { label: 'Mendung', data: [60, 45, 55, 40, 35, 25, 30], borderColor: colorMendung, backgroundColor: colorMendung, tension: 0.3 },
                    { label: 'Hujan', data: [20, 15, 15, 25, 10, 30, 20], borderColor: colorHujan, backgroundColor: colorHujan, tension: 0.3 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }, scales: { y: { max: 100 } } }
        });

        const ctxDistribusi = document.getElementById('distribusiKelasChart').getContext('2d');
        new Chart(ctxDistribusi, {
            type: 'bar',
            data: {
                labels: ['7A', '7B', '8A', '8B', '9A', '10A'],
                datasets: [
                    { label: 'Hujan', data: [10, 20, 15, 5, 25, 10], backgroundColor: colorHujan },
                    { label: 'Mendung', data: [30, 40, 35, 45, 25, 50], backgroundColor: colorMendung },
                    { label: 'Cerah', data: [60, 40, 50, 50, 50, 40], backgroundColor: colorCerah }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12 } } }, scales: { x: { stacked: true }, y: { stacked: true, max: 100 } } }
        });
    });
</script>
@endsection