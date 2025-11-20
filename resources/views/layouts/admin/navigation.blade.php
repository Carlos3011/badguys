<nav x-data="{ open: false }" class="bg-black border-r border-gray-700 sm:min-h-screen relative w-0 sm:w-auto">
    <!-- Background overlays -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800/20 via-transparent to-gray-700/15"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <!-- Sidebar container -->
    <div class="relative z-10 hidden sm:flex flex-col w-64 sm:w-72 p-4">
        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 mb-6">
            <h3 class="text-2xl font-roboto-flex font-bold text-white tracking-wider">BIGI.NYC</h3>
        </a>

        <!-- Navigation -->
        <div class="space-y-2">
            <x-admin.layout.admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                <x-slot:icon>
                    <x-admin.ui.icon name="gauge" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Panel') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="tags" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Categorías') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="box-open" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Productos') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="users" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Clientes') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="receipt" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Pedidos') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="credit-card" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Pagos') }}
            </x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.discounts.index')" :active="request()->routeIs('admin.discounts.index')">
                <x-slot:icon>
                    <x-admin.ui.icon name="percent" class="w-5 h-5" />
                </x-slot:icon>
                {{ __('Descuentos') }}
            </x-admin.layout.admin-nav-link>
        </div>

        <!-- Separator -->
        <div class="my-6 border-t border-gray-700"></div>

        <!-- Account / Auth -->
        @auth
            <div class="space-y-2">
                <div class="px-4 py-2 text-sm text-gray-400">{{ Auth::user()->name }}</div>
                {{-- <a href="{{ route('profile.edit') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg">
                    {{ __('Perfil') }}
                </a> --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg w-full text-left">
                        {{ __('Cerrar sesión') }}
                    </button>
                </form>
            </div>
        @else
            <div class="space-y-2">
                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg">
                    {{ __('Iniciar Sesión') }}
                </a>
                <a href="{{ route('register') }}" class="text-sm text-black bg-white px-4 py-2 rounded-lg hover:bg-gray-200">
                    {{ __('Registrarse') }}
                </a>
            </div>
        @endauth
    </div>

    <!-- Mobile toggle button -->
    <button @click="open = !open" class="sm:hidden fixed top-4 left-4 z-20 inline-flex items-center justify-center p-2 rounded-md text-white bg-gray-800/80 hover:bg-gray-700">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Offcanvas for mobile -->
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/60 sm:hidden" @click="open = false"></div>
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full" class="fixed top-0 left-0 bottom-0 w-72 bg-black border-r border-gray-700 z-30 sm:hidden p-4">
        <!-- Mobile content mirrors desktop -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 mb-6">
            <h3 class="text-2xl font-roboto-flex font-bold text-white tracking-wider">BIGI.NYC</h3>
        </a>
        <div class="space-y-2">
            <x-admin.layout.admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">{{ __('Panel') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">{{ __('Categorías') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index')">{{ __('Productos') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.index')">{{ __('Clientes') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.index')">{{ __('Pedidos') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.index')">{{ __('Pagos') }}</x-admin.layout.admin-nav-link>
            <x-admin.layout.admin-nav-link :href="route('admin.discounts.index')" :active="request()->routeIs('admin.discounts.index')">{{ __('Descuentos') }}</x-admin.layout.admin-nav-link>
        </div>
        <div class="my-6 border-t border-gray-700"></div>
        @auth
            <div class="space-y-2">
                <div class="px-4 py-2 text-sm text-gray-400">{{ Auth::user()->name }}</div>
                <a href="{{ route('profile.edit') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg">{{ __('Perfil') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg w-full text-left">{{ __('Cerrar sesión') }}</button>
                </form>
            </div>
        @else
            <div class="space-y-2">
                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white px-4 py-2 rounded-lg">{{ __('Iniciar Sesión') }}</a>
                <a href="{{ route('register') }}" class="text-sm text-black bg-white px-4 py-2 rounded-lg hover:bg-gray-200">{{ __('Registrarse') }}</a>
            </div>
        @endauth
    </div>
</nav>
