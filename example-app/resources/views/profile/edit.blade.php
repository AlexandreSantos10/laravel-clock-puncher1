<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('user.logs') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-[#161b2c] border dark:border-white/5 rounded-xl text-sm font-bold text-green-500 hover:bg-green-500/10">
                    {{ __('Meus Logs') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-[#161b2c] border dark:border-white/5 rounded-xl text-sm font-bold text-rose-500">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
            <!-- Two-column: profile info + password -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
                <div class="w-full">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="w-full">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Centered delete account card -->
            <div class="flex justify-center">
                <div class="w-full sm:w-3/4 lg:w-1/2">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
