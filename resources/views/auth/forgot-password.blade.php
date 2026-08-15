<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Lupa Password?</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Tenang saja, awan kadang memang menutupi ingatan. Masukkan emailmu di bawah ini dan kami akan mengirimkan tautan untuk membuat password baru.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email yang terdaftar</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Tombol Reset -->
        <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5 mb-4">
            Kirim Tautan Reset Password
        </button>

        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-400 hover:text-slate-600 transition">
                Kembali ke halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>
