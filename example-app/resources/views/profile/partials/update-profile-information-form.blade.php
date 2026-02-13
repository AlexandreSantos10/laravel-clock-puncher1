<section class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5 shadow-sm space-y-6 flex flex-col h-full">
    <header>
        <h2 class="text-2xl font-black text-white tracking-tight">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Atualize as informações do seu perfil e o endereço de email.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 flex-1">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#0b0e14] dark:bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#0b0e14] dark:bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-300">
                        {{ __('O seu email ainda não foi verificado.') }}

                        <button form="send-verification" class="ml-2 inline-block text-sm text-indigo-400 hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{ __('Reenviar email de verificação') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="px-6 py-3 rounded-3xl bg-indigo-600 hover:bg-indigo-500">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-300"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
