@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Daftar Siswa</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau keaktifan siswa dalam mengisi jurnal emosi.</p>
    </div>
    
    <!-- Fitur Pencarian & Filter -->
    <div class="flex gap-3">
        <input type="text" placeholder="Cari nama siswa..." class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 w-64 shadow-sm px-4">
        <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 bg-white shadow-sm">
            <option>Semua Kelas</option>
            <option>Kelas 7</option>
            <option>Kelas 8</option>
            <option>Kelas 9</option>
        </select>
    </div>
</div>

<!-- Tabel Daftar Siswa -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 font-bold">Nama Siswa</th>
                <th class="px-6 py-4 font-bold">Kelas</th>
                <th class="px-6 py-4 font-bold">Total Jurnal</th>
                <th class="px-6 py-4 font-bold">Aktivitas Terakhir</th>
                <th class="px-6 py-4 font-bold text-center">Status</th>
                <th class="px-6 py-4 font-bold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <!-- Baris 1 -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800">Aulia Putri</td>
                <td class="px-6 py-4 text-slate-600">9A</td>
                <td class="px-6 py-4 text-slate-600">12 Catatan</td>
                <td class="px-6 py-4 text-slate-500">Hari ini, 09:05</td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="px-4 py-1.5 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 font-medium transition">Detail</button>
                </td>
            </tr>
            
            <!-- Baris 2 -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800">Bima Saputra</td>
                <td class="px-6 py-4 text-slate-600">8C</td>
                <td class="px-6 py-4 text-slate-600">5 Catatan</td>
                <td class="px-6 py-4 text-slate-500">Kemarin, 14:20</td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="px-4 py-1.5 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 font-medium transition">Detail</button>
                </td>
            </tr>

            <!-- Baris 3 -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800">Citra Kirana</td>
                <td class="px-6 py-4 text-slate-600">7B</td>
                <td class="px-6 py-4 text-slate-600">0 Catatan</td>
                <td class="px-6 py-4 text-slate-400 italic">Belum pernah</td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-full text-xs font-bold">Pasif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="px-4 py-1.5 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 font-medium transition">Detail</button>
                </td>
            </tr>
        </tbody>
    </table>
    
    <!-- Navigasi Halaman (Pagination) -->
    <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between text-sm text-slate-500 bg-slate-50/50">
        <span>Menampilkan 1 hingga 10 dari 1.234 siswa</span>
        <div class="flex gap-1">
            <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-white transition">Sebelumnya</button>
            <button class="px-3 py-1.5 border border-sky-500 bg-sky-50 text-sky-600 rounded-md font-bold">1</button>
            <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-white transition">2</button>
            <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-white transition">3</button>
            <button class="px-3 py-1.5 border border-slate-200 rounded-md hover:bg-white transition">Selanjutnya</button>
        </div>
    </div>
</div>
@endsection