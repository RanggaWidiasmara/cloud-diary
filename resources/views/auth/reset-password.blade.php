<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Buat Password Baru</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Awan kelabu telah berlalu. Silakan buat password barumu di bawah ini.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-4 text-left">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4 text-left">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6 text-left">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5">
            Simpan Password Baru
        </button>
    </form>
</x-guest-layout>
