<nav x-data="{ open: false }" class="bg-black border-b border-gray-700">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 relative">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <h3 class="text-2xl font-roboto-flex font-bold text-white tracking-wider">BIGI.NYC</h3>
                </a>
                <div class="hidden sm:flex sm:ms-10 space-x-8">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link :href="route('productos')" :active="request()->routeIs('productos')">
                        {{ __('Productos') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
                <img id="nav-center-logo" src="{{ asset('image/logo-blanco.png') }}" alt="Logo" class="h-24 w-24 object-contain" />
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
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

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white hover:text-black transition">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'" class="h-6 w-6"></i>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-black border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-white">{{ __('Inicio') }}</a>
            <a href="{{ route('productos') }}" class="block px-4 py-2 text-white">{{ __('Productos') }}</a>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="mt-3 space-y-1">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-white">{{ __('Iniciar Sesión') }}</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-white">{{ __('Registrarse') }}</a>
            </div>
        </div>
    </div>
</nav>

<script>
    (function () {
        var el = document.getElementById('nav-center-logo');
        if (!el) return;
        var angle = 0;
        function tick() {
            angle = (angle + 0.3) % 360;
            el.style.transform = 'rotate(' + angle + 'deg)';
            requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    })();
</script>
