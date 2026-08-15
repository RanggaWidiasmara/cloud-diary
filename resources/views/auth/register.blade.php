<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Daftar Akun Baru</h2>

        <!-- Pesan rayuan khusus buat Guest yang kehabisan kuota -->
        @if(session('has_tried_guest'))
            <p class="text-sm text-sky-600 mt-3 bg-sky-50 p-3 rounded-xl border border-sky-100 font-medium animate-pulse">
                ✨ Yeay! Daftar sekarang untuk menyimpan curhatan dan saran awan pertamamu!
            </p>
        @else
            <p class="text-sm text-slate-500 mt-1">Mulai perjalanan emosimu bersama kami.</p>
        @endif
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Panggilan</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Tombol Register -->
        <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5 mb-4">
            Daftar Sekarang
        </button>

        <p class="text-center text-sm text-slate-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-sky-500 hover:text-sky-700 transition">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
