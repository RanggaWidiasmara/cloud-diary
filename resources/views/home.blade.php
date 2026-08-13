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

        <h2 class="text-2xl font-bold text-slate-800 mb-2">Halo, Selamat Datang!! 😊</h2>
        <p class="text-sm text-slate-500 mb-8">Silakan curhat di bawah ini, dan biarkan awan merepresentasikan perasaanmu hari ini.</p>

        <!-- Area Hasil Awan dari Gemini -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-sky-50 rounded-2xl border border-sky-100 flex flex-col items-center animate-bounce">
                <!-- Memanggil gambar berdasarkan response AI (.jpg) -->
                <img src="{{ asset('images/clouds/' . session('awan') . '.png') }}" alt="{{ session('awan') }}" class="w-32 h-32 object-cover rounded-2xl mb-3 shadow-sm">
                <p class="font-bold text-sky-700">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Input Curhatan -->
        <form action="{{ route('diary.store') }}" method="POST">
            @csrf
            <textarea
                name="content"
                rows="4"
                class="w-full rounded-2xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-4 mb-4 resize-none shadow-sm transition"
                placeholder="Ketik apa yang kamu rasakan saat ini..."
                required></textarea>

            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5">
                Submit Curhatan
            </button>
        </form>

    </div>
</div>
@endsection
