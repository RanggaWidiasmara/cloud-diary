<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Diary</title>
    <!-- Vite buat nyambungin ke Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- Sidebar Kiri -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between h-full shrink-0">
        <div>
            <!-- Header Logo -->
            <div class="h-20 flex items-center px-8 border-b border-slate-50 mb-4">
                <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="text-sky-500 text-2xl">☁️</span> Cloud Diary
                </h1>
            </div>

            <!-- Menu Navigasi -->
            <nav class="px-4 flex flex-col gap-2">
                <a href="{{ route('home') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Home
                </a>
                <a href="{{ route('profile') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('profile') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Profil
                </a>
                <a href="{{ route('history') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('history') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Riwayat Curhat
                </a>
            </nav>
        </div>

        <!-- Tombol Logout Beneran (Bawaan Breeze) -->
        <div class="p-4 border-t border-slate-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl transition font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Kanan Utama -->
    <main class="flex-1 overflow-y-auto">
        <!-- Di sini letak ajaibnya buat nyambungin halaman yang lu bikin kemarin -->
        @yield('content')
    </main>

</body>
</html>
