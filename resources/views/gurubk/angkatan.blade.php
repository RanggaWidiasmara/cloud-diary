@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Histori Angkatan</h1>
        <p class="text-sm text-slate-500 mt-1">Arsip data emosi dan riwayat tindakan siswa yang sudah lulus.</p>
    </div>
</div>

<!-- Kotak Filter Histori -->
<div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex gap-4 mb-6">
    <input type="text" placeholder="Cari nama alumni atau NISN..." class="flex-1 text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 px-4 border">
    
    <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 w-48 border">
        <option>Pilih Tahun Lulus</option>
        <option>Angkatan 2026</option>
        <option>Angkatan 2025</option>
        <option>Angkatan 2024</option>
    </select>

    <button class="bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">
        Tampilkan Histori
    </button>
</div>

<!-- Tabel Dummy Data Alumni -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 font-bold">Nama Alumni</th>
                <th class="px-6 py-4 font-bold">Tahun Lulus</th>
                <th class="px-6 py-4 font-bold">Status Akhir</th>
                <th class="px-6 py-4 font-bold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800">Bima Arya</td>
                <td class="px-6 py-4 text-slate-600">2025</td>
                <td class="px-6 py-4">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Diarsipkan</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="text-sky-500 hover:text-sky-600 transition px-2 font-medium">Lihat Rapor Emosi</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection