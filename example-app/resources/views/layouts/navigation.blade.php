<nav x-data="{ open: false }" class="bg-white dark:bg-[#111625] border-b border-gray-100 dark:border-white/5 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/mind.png') }}" alt="Logo" class="hidden sm:block h-9 w-auto">
                        
                   </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="dark:text-gray-300">
                        {{ __('Página Inicial') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::user()->tipo === 'admin')
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-500 dark:text-gray-400 bg-white dark:bg-[#161b2c] hover:text-indigo-500 dark:hover:text-indigo-400 focus:outline-none transition ease-in-out duration-150 border dark:border-white/5 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 me-2 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4M6 12h12M6 20h12"/></svg>
                            Definições
                        </a>

                        <a href="{{ route('admin.panel') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-500 dark:text-gray-400 bg-white dark:bg-[#161b2c] hover:text-indigo-500 dark:hover:text-indigo-400 focus:outline-none transition ease-in-out duration-150 border dark:border-white/5 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 me-2 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                            Gestão
                        </a>
                    </div>
                @else
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-500 dark:text-gray-400 bg-white dark:bg-[#161b2c] hover:text-indigo-500 dark:hover:text-indigo-400 focus:outline-none transition ease-in-out duration-150 border dark:border-white/5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 me-2 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4M6 12h12M6 20h12"/></svg>
                        Definições
                    </a>
                @endif
            </div>

            <div class="-me-2 flex items-center sm:hidden w-full justify-between">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center p-3 rounded-full bg-white dark:bg-[#161b2c] border dark:border-white/5 shadow-sm">
                    <img src="{{ asset('images/mind.png') }}" alt="Logo" class="h-10 w-10 rounded-full">
                </a>

                @if(Auth::user()->tipo === 'admin')
                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center p-3 rounded-full bg-white dark:bg-[#161b2c] border dark:border-white/5 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4M6 12h12M6 20h12"/></svg>
                        </a>
                        <a href="{{ route('admin.panel') }}" class="inline-flex items-center justify-center p-3 rounded-full bg-white dark:bg-[#161b2c] border dark:border-white/5 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                        </a>
                    </div>
                @else
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center p-3 rounded-full bg-white dark:bg-[#161b2c] border dark:border-white/5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4M6 12h12M6 20h12"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="hidden">
        <div class="pt-2 pb-3 space-y-1 border-b border-gray-200 dark:border-white/5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->tipo === 'admin')
                <x-responsive-nav-link :href="route('admin.panel')" class="text-indigo-400 font-bold">
                    {{ __('Gestão Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.statistics')" class="text-purple-400 font-bold">
                    {{ __('Estatísticas') }}
                </x-responsive-nav-link>
            @endif
        </div>

            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-bold text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-indigo-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->tipo === 'admin')
                    <x-responsive-nav-link :href="route('user.logs')" class="text-green-500 italic">
                        {{ __('Meus Logs') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-500">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('profile.edit')" class="font-bold">
                        {{ __('Definições') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-500">
                            {{ __('Sair') }}
                        </x-responsive-nav-link>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>