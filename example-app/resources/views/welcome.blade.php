<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clock Puncher - Gestão de Ponto</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">

    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-indigo-500 selection:text-white">
        
        <div class="absolute top-0 right-0 p-6 text-right z-10">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Registar</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
            
            <div class="text-center py-16">
                <div class="flex justify-center mb-6">
                    <div class="bg-indigo-600 p-4 rounded-full shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                    Clock <span class="text-indigo-600">Puncher</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    A forma mais simples e eficiente de gerir o teu tempo. Regista entradas, saídas e pausas com apenas um clique.
                </p>

                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-500 transition duration-300">
                        Bater Ponto Agora
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-600 font-bold border border-indigo-200 rounded-lg shadow-sm hover:bg-gray-50 transition duration-300">
                        Criar Conta
                    </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 px-4">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Registo em Tempo Real</h3>
                    <p class="text-gray-600 text-sm">Marca as tuas entradas e saídas com precisão de segundos. Nunca mais percas um minuto.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Histórico Detalhado</h3>
                    <p class="text-gray-600 text-sm">Acede a todos os teus registos passados, organiza por mês e exporta os dados.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Simples e Rápido</h3>
                    <p class="text-gray-600 text-sm">Interface limpa e intuitiva. Focado na produtividade sem complicações.</p>
                </div>
            </div>

            <div class="mt-16 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Clock Puncher. Todos os direitos reservados.
            </div>
        </div>
    </div>
</body>
</html>