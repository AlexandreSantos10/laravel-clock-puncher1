<section class="bg-[#161b2c] p-8 rounded-[2.5rem] border border-white/5 shadow-sm space-y-6">
    <header>
        <h2 class="text-2xl font-black text-white tracking-tight">
            {{ __('Eliminar Conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ao eliminar a sua conta, todos os recursos e dados serão apagados permanentemente. Faça o download de quaisquer dados que pretenda conservar antes de prosseguir.') }}
        </p>
    </header>

    <div>
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-4 py-2 rounded-3xl bg-rose-600 hover:bg-rose-500"
        >{{ __('Eliminar Conta') }}</x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#0b0e14] rounded-xl border border-white/5">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-white">
                {{ __('Tem a certeza que pretende eliminar a sua conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Ao confirmar, todos os seus dados serão removidos permanentemente. Introduza a sua palavra-passe para confirmar.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Palavra-passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-[#0b0e14] border-none text-gray-200 rounded-2xl p-3"
                    placeholder="{{ __('Palavra-passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 px-4 py-2 rounded-3xl bg-rose-600 hover:bg-rose-500">
                    {{ __('Eliminar Conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
