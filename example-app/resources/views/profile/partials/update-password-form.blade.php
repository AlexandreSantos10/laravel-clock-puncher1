<section class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5 shadow-sm space-y-6 flex flex-col h-full">
    <header>
        <h2 class="text-2xl font-black text-white tracking-tight">
            {{ __('Atualizar Palavra-passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Certifique-se de que a sua conta utiliza uma palavra-passe forte para manter a segurança.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 flex-1">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Palavra-passe Atual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-[#0b0e14] dark:bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nova Palavra-passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-[#0b0e14] dark:bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Palavra-passe')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-[#0b0e14] dark:bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="px-6 py-3 rounded-3xl bg-indigo-600 hover:bg-indigo-500">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
