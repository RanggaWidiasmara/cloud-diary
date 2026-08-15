@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 max-w-4xl mx-auto space-y-6 pb-12">

    <!-- Header Halaman -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Profil Akun ☁️</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola identitas dan keamanan awanmu di sini.</p>
    </div>

    <!-- 1. Form Update Profil -->
    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100">
        <header class="mb-6">
            <h3 class="text-lg font-bold text-slate-800">Informasi Profil</h3>
            <p class="text-sm text-slate-500">Perbarui nama panggilan dan alamat email akunmu.</p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-xl">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Panggilan</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 text-sm p-3 transition shadow-sm">
                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 text-sm p-3 transition shadow-sm">
                <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-sm">
                    Simpan Perubahan
                </button>

                @if (session('status') === 'profile-updated')
                    <p class="text-sm text-sky-600 font-medium bg-sky-50 px-3 py-1 rounded-lg">Berhasil disimpan! ✨</p>
                @endif
            </div>
        </form>
    </div>

    <!-- 2. Form Update Password -->
    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100">
        <header class="mb-6">
            <h3 class="text-lg font-bold text-slate-800">Ubah Password 🔒</h3>
            <p class="text-sm text-slate-500">Pastikan akunmu menggunakan password yang panjang dan acak agar tetap aman.</p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-xl">
            @csrf
            @method('put')

            <div>
                <label for="update_password_current_password" class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                    class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 text-sm p-3 transition shadow-sm">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-500" />
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                    class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 text-sm p-3 transition shadow-sm">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                    class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 text-sm p-3 transition shadow-sm">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-sm">
                    Simpan Password
                </button>

                @if (session('status') === 'password-updated')
                    <p class="text-sm text-green-600 font-medium bg-green-50 px-3 py-1 rounded-lg">Password diperbarui! 🛡️</p>
                @endif
            </div>
        </form>
    </div>

    <!-- 3. Form Hapus Akun -->
    <div class="bg-red-50/50 rounded-3xl p-6 md:p-8 shadow-sm border border-red-100" x-data="{ confirmingUserDeletion: false }">
        <header class="mb-6">
            <h3 class="text-lg font-bold text-red-600">Hapus Akun ⚠️</h3>
            <p class="text-sm text-slate-600">Sekali akun dihapus, semua data dan riwayat awanmu akan hilang selamanya.</p>
        </header>

        <button @click="confirmingUserDeletion = true" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-sm">
            Hapus Akun Saya
        </button>

        <!-- Modal Konfirmasi Alpine.js -->
        <div x-show="confirmingUserDeletion" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-slate-900/50 backdrop-blur-sm" x-transition.opacity>
            <div @click.away="confirmingUserDeletion = false" class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-xl border border-slate-100">

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-bold text-slate-800 mb-2">Apakah kamu yakin ingin menghapus akun?</h2>
                    <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                        Jika kamu menghapus akun, seluruh data curhatan dan riwayatmu akan terhapus secara permanen. Masukkan passwordmu untuk mengonfirmasi.
                    </p>

                    <div class="mb-6">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" placeholder="Masukkan Password" required
                            class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring focus:ring-red-200 text-sm p-3 transition shadow-sm">
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" @click="confirmingUserDeletion = false" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-red-500 rounded-xl hover:bg-red-600 transition shadow-sm">
                            Hapus Permanen
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection
