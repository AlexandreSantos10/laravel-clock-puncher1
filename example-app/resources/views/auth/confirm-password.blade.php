<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-12 mx-auto mb-2">
                <h1 class="text-2xl font-black text-white">Confirmar Palavra-passe</h1>
                <p class="text-sm text-gray-400 mt-1">Esta é uma área segura. Confirme a sua palavra-passe para continuar.</p>
            </div>

            <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="py-3 px-6 rounded-3xl bg-indigo-600 hover:bg-indigo-500">Confirmar</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
