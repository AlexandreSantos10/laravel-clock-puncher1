<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-12 mx-auto mb-2">
                <h1 class="text-2xl font-black text-white">Criar Conta</h1>
                <p class="text-sm text-gray-400 mt-1">Registe-se para aceder ao painel</p>
            </div>

            <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <a class="text-sm text-gray-400" href="{{ route('login') }}">Já tem conta?</a>

                            <x-primary-button class="py-3 px-6 rounded-3xl bg-indigo-600 hover:bg-indigo-500">Registar</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
