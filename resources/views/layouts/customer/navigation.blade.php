<nav x-data="{ open: false }" class="bg-black border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('customer.home') }}" class="flex items-center space-x-3">
                    <h3 class="text-2xl font-roboto-flex font-bold text-white tracking-wider">BADGUYS</h3>
                </a>
                <div class="hidden sm:flex sm:ms-10 space-x-8">
                    <x-customer.layout.nav-link :href="route('customer.home')" :active="request()->routeIs('customer.home')">
                        {{ __('Inicio') }}
                    </x-customer.layout.nav-link>
                    <x-customer.layout.nav-link :href="route('customer.products.index')" :active="request()->routeIs('customer.products.index')">
                        {{ __('Productos') }}
                    </x-customer.layout.nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-white bg-black border border-white/20 hover:bg-white hover:text-black transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white hover:text-black transition">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'" class="h-6 w-6"></i>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('customer.home') }}" class="block px-4 py-2 text-white">{{ __('Inicio') }}</a>
            <a href="{{ route('customer.products.index') }}" class="block px-4 py-2 text-white">{{ __('Productos') }}</a>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white">{{ __('Perfil') }}</a>
                <form method="POST" action="{{ route('logout') }}" class="px-4">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block py-2 text-white">{{ __('Cerrar sesión') }}</a>
                </form>
            </div>
        </div>
    </div>
</nav>
