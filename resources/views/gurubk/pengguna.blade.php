@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola hak akses Admin, Guru BK, dan data akun Siswa.</p>
    </div>
    
    <!-- Tombol Tambah Pengguna -->
    <button class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2.5 px-5 rounded-xl transition duration-200 shadow-sm flex items-center gap-2">
        <span>+</span> Tambah Pengguna
    </button>
</div>

<!-- Kotak Pencarian dan Filter -->
<div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex gap-4 mb-6">
    <input type="text" placeholder="Cari nama atau email..." class="flex-1 text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 px-4">
    
    <!-- Filter Kelas Baru -->
    <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 w-36">
        <option>Semua Kelas</option>
        <option>Kelas 10</option>
        <option>Kelas 11</option>
        <option>Kelas 12</option>
    </select>

    <select class="text-sm border-slate-200 rounded-lg text-slate-600 focus:border-sky-500 focus:ring-sky-500 w-48">
        <option>Semua Peran (Role)</option>
        <option>Admin</option>
        <option>Guru BK</option>
        <option>Siswa</option>
    </select>
</div>

<!-- Tabel Daftar Pengguna -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 font-bold">Nama Pengguna</th>
                <th class="px-6 py-4 font-bold">Email</th>
                <th class="px-6 py-4 font-bold">Kelas</th>
                <th class="px-6 py-4 font-bold">Peran (Role)</th>
                <th class="px-6 py-4 font-bold">Status</th>
                <th class="px-6 py-4 font-bold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            
            <!-- Baris 1: Admin -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs">SA</div>
                    Super Admin
                </td>
                <td class="px-6 py-4 text-slate-600">admin@clouddiary.com</td>
                <td class="px-6 py-4 text-slate-400">-</td>
                <td class="px-6 py-4">
                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Admin</span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-green-500 font-medium text-xs flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="text-slate-400 hover:text-sky-500 transition px-2">Edit</button>
                </td>
            </tr>

            <!-- Baris 2: Guru BK -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center font-bold text-xs">BR</div>
                    Bu Rina
                </td>
                <td class="px-6 py-4 text-slate-600">rina.bk@smaxyz.sch.id</td>
                <td class="px-6 py-4 text-slate-400">-</td>
                <td class="px-6 py-4">
                    <span class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Guru BK</span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-green-500 font-medium text-xs flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="text-slate-400 hover:text-sky-500 transition px-2">Edit</button>
                    <button class="text-slate-400 hover:text-red-500 transition px-2">Hapus</button>
                </td>
            </tr>

            <!-- Baris 3: Siswa -->
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium text-slate-800 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">AP</div>
                    Aulia Putri
                </td>
                <td class="px-6 py-4 text-slate-600">aulia.p@siswa.smaxyz.sch.id</td>
                <td class="px-6 py-4 text-slate-600 font-medium">10C</td>
                <td class="px-6 py-4">
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Siswa</span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-green-500 font-medium text-xs flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button class="text-slate-400 hover:text-sky-500 transition px-2">Edit</button>
                    <button class="text-slate-400 hover:text-red-500 transition px-2">Reset Sandi</button>
                </td>
            </tr>

        </tbody>
    </table>
</div>
@endsection