<nav x-data="{ open: false }" class="bg-black border-b border-gray-600 relative overflow-hidden">
    <!-- Simplified background patterns -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800/20 via-transparent to-gray-700/15"></div>
        
        <!-- Simplified grid pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
    </div>
    
    <!-- Simplified border -->
    <div class="absolute bottom-0 left-0 w-full h-1 bg-white"></div>
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                       
                        <h3 class="text-2xl font-roboto-flex font-bold text-white tracking-wider">
                            BADGUYS
                        </h3>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('productos')" :active="request()->routeIs('productos')">
                        {{ __('Productos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('categorias')" :active="request()->routeIs('categorias')">
                        {{ __('Categorías') }}
                    </x-nav-link>
                    <x-nav-link :href="route('nosotros')" :active="request()->routeIs('nosotros')">
                        {{ __('Nosotros') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')">
                        {{ __('Contacto') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Usuario no autenticado -->
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="group relative px-4 py-2 text-gray-300 hover:text-white text-sm font-montserrat font-medium transition-all duration-300 hover:scale-105">
                        <span class="relative z-10">{{ __('Iniciar Sesión') }}</span>
                        <div class="absolute inset-0 bg-gray-800/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    <a href="{{ route('register') }}" class="group relative px-6 py-2 bg-white text-black font-montserrat text-sm font-bold rounded-xl shadow-lg hover:bg-gray-200 transform hover:scale-105 hover:-translate-y-0.5 transition-all duration-300 overflow-hidden border border-gray-300">
                        <span class="relative z-10">{{ __('Registrarse') }}</span>
                    </a>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 hover:bg-gray-800 focus:outline-none focus:bg-gray-800 focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black/95 backdrop-blur-sm border-t border-gray-600">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('productos')" :active="request()->routeIs('productos')">
                {{ __('Productos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categorias')" :active="request()->routeIs('categorias')">
                {{ __('Categorías') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('nosotros')" :active="request()->routeIs('nosotros')">
                {{ __('Nosotros') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')">
                {{ __('Contacto') }}
            </x-responsive-nav-link>
        </div>

        
        <div class="pt-4 pb-1 border-t border-gray-600">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Iniciar Sesión') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Registrarse') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
