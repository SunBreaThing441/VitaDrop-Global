<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VitaDrop Global') }} — UNESCO Humanitarian Blood Initiative</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased mesh-backdrop text-slate-800">
        <div class="min-h-screen flex flex-col justify-between py-8 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Decorative Ambient Glow Orbs -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-unesco-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-vitality-400/15 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="flex-grow flex items-center justify-center relative z-10">
                {{ $slot }}
            </div>

            <!-- Footer Badge -->
            <footer class="mt-8 text-center text-xs font-medium text-slate-500 relative z-10 flex items-center justify-center gap-2">
                <span>&copy; {{ date('Y') }} VitaDrop Global.</span>
                <span class="inline-block w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="text-unesco-600 font-semibold">UNESCO Humanitarian Blood Protocol</span>
            </footer>
        </div>
    </body>
</html>
