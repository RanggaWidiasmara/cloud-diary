@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Sistem</h1>
        <p class="text-sm text-slate-500 mt-1">Konfigurasi dasar aplikasi Cloud Diary dan parameter AI.</p>
    </div>
    <button class="bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 px-5 rounded-xl transition shadow-sm">
        Simpan Perubahan
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Kolom Kiri: Navigasi Pengaturan -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-fit">
        <ul class="divide-y divide-slate-100">
            <li><a href="#" class="block px-6 py-4 bg-sky-50 text-sky-600 font-semibold border-l-4 border-sky-500">Profil Sekolah</a></li>
            <li><a href="#" class="block px-6 py-4 text-slate-600 hover:bg-slate-50 transition">Notifikasi & Email</a></li>
            <li><a href="#" class="block px-6 py-4 text-slate-600 hover:bg-slate-50 transition">Parameter AI Triage</a></li>
            <li><a href="#" class="block px-6 py-4 text-slate-600 hover:bg-slate-50 transition">Keamanan Akun</a></li>
        </ul>
    </div>

    <!-- Kolom Kanan: Form Pengaturan -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="font-bold text-slate-800 mb-4">Informasi Sekolah</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Nama Sekolah</label>
                    <input type="text" value="SMA XYZ Surabaya" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">Tahun Ajaran Aktif</label>
                    <select class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border">
                        <option>2026/2027 - Ganjil</option>
                        <option>2025/2026 - Genap</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection