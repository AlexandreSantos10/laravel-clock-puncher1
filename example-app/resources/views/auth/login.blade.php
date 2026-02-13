<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-12 mx-auto mb-2">
                <h1 class="text-2xl font-black text-white">Iniciar Sessão</h1>
                <p class="text-sm text-gray-400 mt-1">Entre na sua conta para continuar</p>
            </div>

            <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-300">Lembrar</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-indigo-400 hover:text-indigo-300 ml-auto whitespace-nowrap" href="{{ route('password.request') }}">Esqueceu a palavra-passe?</a>
                            @endif
                        </div>

                        <div class="pt-2">
                            <x-primary-button class="w-full py-3 rounded-3xl bg-indigo-600 hover:bg-indigo-500">Iniciar Sessão</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-center text-sm text-gray-500 mt-4">Ainda não tem conta? <a href="{{ route('register') }}" class="text-indigo-400">Registar</a></p>
        </div>
    </div>
</x-guest-layout>
