<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-6">
                <img src="{{ asset('images/mind.png') }}" alt="Mindshaker" class="h-12 mx-auto mb-2">
                <h1 class="text-2xl font-black text-white">Verificar Email</h1>
                <p class="text-sm text-gray-400 mt-1">Antes de começar, verifique o seu email clicando no link que enviámos.</p>
            </div>

            <div class="bg-[#161b2c] p-8 rounded-[1.5rem] border border-white/5 shadow-sm">
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-400">
                        {{ __('Um novo link de verificação foi enviado para o email que forneceu.') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="w-full py-3 rounded-3xl bg-indigo-600 hover:bg-indigo-500">Reenviar Email de Verificação</x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-3xl border border-white/10 text-gray-300">Terminar Sessão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
