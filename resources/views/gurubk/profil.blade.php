@extends('layouts.gurubk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Profil Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden max-w-2xl">
    
    <!-- Bagian Foto Profil -->
    <div class="p-6 border-b border-slate-200 flex items-center gap-6">
        <div class="w-20 h-20 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-3xl shadow-inner">BR</div>
        <div>
            <button class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition shadow-sm">Ubah Foto</button>
            <button class="px-4 py-2 text-red-500 text-sm font-medium hover:bg-red-50 rounded-lg transition ml-2">Hapus</button>
        </div>
    </div>

    <!-- Formulir Data Diri -->
    <div class="p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Nama Lengkap</label>
            <input type="text" value="Bu Rina" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Alamat Email</label>
            <input type="email" value="rina.bk@smaxyz.sch.id" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1">Peran Akses</label>
            <input type="text" value="Guru BK" disabled class="w-full text-sm bg-slate-50 border-slate-200 rounded-lg text-slate-400 p-2.5 border cursor-not-allowed">
        </div>
        
        <hr class="border-slate-100 my-2">
        
        <!-- Bagian Ganti Password -->
        <div class="space-y-4">
            <h3 class="font-bold text-slate-800 mb-3">Keamanan Akun</h3>
            
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Password Sekarang</label>
                <input type="password" placeholder="Masukkan password saat ini" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border shadow-sm">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Password Baru</label>
                <input type="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border shadow-sm">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Ulang Password Baru</label>
                <input type="password" placeholder="Ketik ulang password baru" class="w-full text-sm border-slate-200 rounded-lg text-slate-800 focus:border-sky-500 focus:ring-sky-500 p-2.5 border shadow-sm">
            </div>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="p-6 border-t border-slate-200 bg-slate-50 flex justify-end">
        <button class="bg-sky-500 hover:bg-sky-600 text-white font-medium py-2.5 px-6 rounded-xl transition shadow-sm">
            Simpan Perubahan
        </button>
    </div>
    
</div>
@endsection