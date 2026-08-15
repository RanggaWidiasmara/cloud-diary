<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Masuk ke Akunmu</h2>
        <p class="text-sm text-slate-500 mt-1">Lanjutkan perjalanan emosimu hari ini.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4 text-left">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4 text-left">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-sky-500 hover:text-sky-700 transition font-medium" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="block mb-6 text-left">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-sky-500 shadow-sm focus:ring-sky-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>
        </div>

        <!-- Tombol Login -->
        <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5 mb-4">
            Masuk
        </button>

        <!-- Garis Pemisah -->
        <div class="flex items-center my-5">
            <div class="grow border-t border-slate-200"></div>
            <span class="px-3 text-xs text-slate-400 font-medium uppercase tracking-wider">Atau</span>
            <div class="grow border-t border-slate-200"></div>
        </div>

        <!-- Tombol Guest Mode -->
        <a href="{{ route('home') }}" class="block w-full text-center bg-white border-2 border-sky-100 hover:border-sky-200 text-sky-600 font-semibold py-3 px-4 rounded-xl transition duration-200 hover:bg-sky-50 mb-6 shadow-sm">
            ☁️ Coba Curhat Tanpa Login
        </a>

        <!-- Link Register -->
        <p class="text-center text-sm text-slate-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-sky-500 hover:text-sky-700 transition">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>
