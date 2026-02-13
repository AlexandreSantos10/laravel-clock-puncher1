<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-12 mx-auto mb-2">
                <h1 class="text-2xl font-black text-white">Recuperar Palavra-passe</h1>
                <p class="text-sm text-gray-400 mt-1">Insira o seu email e enviaremos um link para redefinir a palavra-passe.</p>
            </div>

            <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="py-3 px-6 rounded-3xl bg-indigo-600 hover:bg-indigo-500">Enviar Link</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
