@extends('layouts.app')

@section('content')
<div class="p-8 max-w-3xl mx-auto h-full flex flex-col items-center justify-center mt-12">

    <!-- Wadah Avatar (Melayang di atas kotak) -->
    <div class="z-10 -mb-12">
        <img src="https://ui-avatars.com/api/?name=Tamu+Misterius&background=0ea5e9&color=fff&size=128"
             alt="Avatar"
             class="w-28 h-28 rounded-full shadow-md border-4 border-slate-50 object-cover">
    </div>

    <!-- Kotak Utama -->
    <div class="bg-white w-full rounded-3xl shadow-sm border border-slate-100 pt-16 pb-8 px-10 text-center">

        <h2 class="text-2xl font-bold text-slate-800">Tamu Misterius</h2>
        <p class="text-slate-500 mb-8">guest@clouddiary.com</p>

        <!-- Statistik -->
        <div class="flex justify-center gap-12 mb-8 py-6 border-y border-slate-100">
            <div>
                <span class="block text-2xl font-bold text-sky-500">12</span>
                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-1">Total Curhat</span>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div>
                <span class="block text-2xl font-bold text-sky-500">3</span>
                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-1">Minggu Aktif</span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col gap-3 max-w-md mx-auto">
            <button class="w-full bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold py-3.5 rounded-2xl transition border border-slate-200">
                Edit Profil
            </button>
            <button class="w-full text-red-500 hover:bg-red-50 font-semibold py-3.5 rounded-2xl transition">
                Logout
            </button>
        </div>

    </div>

</div>
@endsection
