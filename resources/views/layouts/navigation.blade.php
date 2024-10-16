<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link>
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('livros.index')" :active="request()->routeIs('livros.*')">
                        Livros
                    </x-nav-link>
                    <x-nav-link :href="route('autores.index')" :active="request()->routeIs('autores.*')">
                        Autores
                    </x-nav-link>
                    <x-nav-link :href="route('assuntos.index')" :active="request()->routeIs('assuntos.*')">
                        Assuntos
                    </x-nav-link>

                    <!-- Dropdown para Relatórios -->
                    <div style="padding-top: 20px; z-index: 10" @mouseenter="open = true" @mouseleave="open = false">
                        <x-nav-link>
                            Relatórios
                        </x-nav-link>
                        <div x-show="open" class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                            <x-nav-link :href="url('/relatorio')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Relatório</x-nav-link>
                            <x-nav-link :href="url('/relatorio/graficos')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Relatório Gráficos</x-nav-link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Configurações -->
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Links para navegação responsiva -->
        </div>

        <!-- Opções de Configuração -->
    </div>
</nav>
