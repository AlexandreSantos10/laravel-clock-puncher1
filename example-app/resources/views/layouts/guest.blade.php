<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
</head>
    <body class="font-sans antialiased bg-[#0b0e14] text-gray-300">
        <div class="min-h-screen flex items-center justify-center py-12 px-4">
            <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="hidden md:flex items-center justify-center">
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="inline-block">
                            <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-28 mx-auto mb-4">
                        </a>
                        <a href="{{ url('/') }}" class="inline-block">
                            <h2 class="text-3xl font-black text-white">Mindshaker</h2>
                        </a>
                        <p class="text-gray-400 mt-2">Gestão de presenças e registos</p>
                    </div>
                </div>

                <div class="mx-auto w-full sm:max-w-xl lg:max-w-2xl">
                    <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
