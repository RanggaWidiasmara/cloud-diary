@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-slate-50 p-4">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 w-full max-w-md text-center relative overflow-hidden">

        <!-- Header Tamu/User -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-sky-500">☁️</div>
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider border border-slate-200 px-3 py-1 rounded-full">
                {{ Auth::user()->name ?? 'GUEST' }}
            </div>
        </div>

        <!-- LOGIKA INTERAKTIF: Cek apakah user baru saja curhat -->
        @if (session('awan'))

            <!-- STATE 1: SETELAH CURHAT -->
            <h2 class="text-2xl font-bold text-slate-800 mb-2">
                Hai, sepertinya kamu sedang <span class="text-sky-500 uppercase">{{ session('awan') }}</span> ya? ☁️
            </h2>
            <p class="text-sm text-slate-500 mb-6">Berikut adalah gambaran perasaanmu dan saran untuk hari ini.</p>

            <!-- Area Hasil Awan dari Gemini -->
            <div class="mb-4 p-4 bg-sky-50 rounded-2xl border border-sky-100 flex flex-col items-center animate-bounce">
                <!-- Memastikan gambar awan dipanggil sesuai session -->
                <img src="{{ asset('images/clouds/' . session('awan') . '.png') }}" alt="{{ session('awan') }}" class="w-32 h-32 object-cover rounded-2xl mb-3 shadow-sm">
                <p class="font-bold text-sky-700">{{ session('success') }}</p>
            </div>

            <!-- Area Saran AI (Muncul di bawah awan) -->
            @if (session('saran'))
            <div class="mb-6 p-4 bg-indigo-50 border-l-4 border-indigo-400 rounded-r-xl text-left shadow-sm">
                <div class="flex items-center mb-2">
                    <span class="text-indigo-500 mr-2">✨</span>
                    <span class="font-semibold text-indigo-700 text-sm">Pesan dari Awan:</span>
                </div>
                <p class="text-sm text-indigo-800 italic">"{{ session('saran') }}"</p>
            </div>
            @endif

        @else

            <!-- STATE 2: BARU DATANG / BELUM CURHAT -->
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Halo, Selamat Datang!! 😊</h2>
            <p class="text-sm text-slate-500 mb-6">Silakan curhat di bawah ini, dan biarkan awan merepresentasikan perasaanmu hari ini.</p>

            <!-- Opsional: Menampilkan awan default (misal cerah) agak transparan biar desainnya nggak kosong -->
            <div class="mb-6 flex justify-center opacity-70 hover:opacity-100 transition duration-300">
                <img src="{{ asset('images/clouds/cerah.png') }}" alt="Awan Default" class="w-32 h-32 object-cover rounded-2xl shadow-sm">
            </div>

        @endif

        <!-- Area Pesan Error Sistem (Misal API Down) -->
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-sm border border-red-100">
                {{ session('error') }}
            </div>
        @endif

        <!-- Area Pesan Error Validasi (Misal kelebihan 1000 karakter) -->
        @error('content')
            <div class="mb-4 p-3 bg-red-50 text-red-600 rounded-xl text-xs text-left border border-red-100">
                {{ $message }}
            </div>
        @enderror

        <!-- Form Input Curhatan (Dengan Anti Double-Submit) -->
        <form action="{{ route('diary.store') }}" method="POST" onsubmit="document.getElementById('btnSubmit').disabled=true; document.getElementById('btnSubmit').innerText='Menghubungi awan... ☁️'; document.getElementById('btnSubmit').classList.add('opacity-70', 'cursor-not-allowed');">
            @csrf
            <textarea
                name="content"
                rows="4"
                maxlength="1000"
                class="w-full rounded-2xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-4 mb-4 resize-none shadow-sm transition"
                placeholder="Ketik apa yang kamu rasakan saat ini (Maks. 1000 karakter)..."
                required></textarea>

            <button id="btnSubmit" type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5">
                Submit Curhatan
            </button>
        </form>

    </div>
</div>
@endsection
