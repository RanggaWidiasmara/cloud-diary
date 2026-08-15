<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cloud Diary') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts & Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-50 flex items-center justify-center min-h-screen p-4">

        <!-- Wadah Card Utama yang Senada dengan Home -->
        <div class="w-full max-w-md bg-white rounded-3xl shadow-sm border border-slate-100 p-8 relative overflow-hidden">

            <!-- Logo Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block text-5xl mb-2 hover:scale-110 transition-transform duration-200">☁️</a>
                <h1 class="text-2xl font-bold text-slate-800">Cloud Diary</h1>
            </div>

            <!-- Di sini letak Login/Register/dll akan dirender -->
            {{ $slot }}

        </div>

    </body>
</html>
