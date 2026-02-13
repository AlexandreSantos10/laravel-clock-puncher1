<nav x-data="{ open: false }" class="bg-white dark:bg-[#111625] border-b border-gray-100 dark:border-white/5 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/mind.png') }}" alt="Logo" class="h-9 w-auto">
                        
                   </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="dark:text-gray-300">
                        {{ __('Página Inicial') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-gray-500 dark:text-gray-400 bg-white dark:bg-[#161b2c] hover:text-indigo-500 dark:hover:text-indigo-400 focus:outline-none transition ease-in-out duration-150 border dark:border-white/5 shadow-sm">
                            <div class="flex flex-col items-start mr-2">
                                <span class="leading-none text-xs text-gray-500 mb-0.5">Olá,</span>
                                <span class="leading-none">{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->tipo === 'admin')
                            <div class="block px-4 py-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">Controlo Admin</div>
                            <x-dropdown-link :href="route('admin.panel')" class="text-indigo-500 font-bold hover:bg-indigo-500/10">
                                {{ __('Gestão de Equipa') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.statistics')" class="text-purple-500 font-bold hover:bg-purple-500/10">
                                {{ __('Estatísticas & Logs') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                        @endif

                        <div class="block px-4 py-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">Minha Área</div>
                        <x-dropdown-link :href="route('user.logs')" class="text-green-500 font-bold hover:bg-green-500/10 italic">
                            {{ __('Meus Logs') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Editar Perfil') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-500 font-bold">
                                {{ __('Terminar Sessão') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 dark:bg-[#0b0e14]">
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
            </div>
        </div>
    </div>
</nav>