<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-roboto-flex font-bold text-gray-900 mb-2">
            INICIAR <span class="text-black">SESIÓN</span>
        </h2>
        <p class="text-gray-600 font-montserrat text-sm">Accede a tu cuenta BIGI.NYC</p>
        <div class="h-0.5 w-16 bg-black mx-auto mt-3 rounded-full"></div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <x-text-input id="email" 
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all duration-200 font-montserrat bg-gray-50 focus:bg-white" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <x-text-input id="password" 
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all duration-200 font-montserrat bg-gray-50 focus:bg-white"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-black shadow-sm focus:ring-black focus:ring-2 transition-all duration-200" 
                    name="remember">
                <span class="ml-3 text-sm text-gray-600 font-montserrat group-hover:text-gray-800 transition-colors duration-200">
                    {{ __('Recordarme') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-black hover:text-gray-700 font-montserrat font-medium transition-colors duration-200 hover:underline" 
                   href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full bg-black hover:bg-gray-800 text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('INICIAR SESIÓN') }}
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 font-montserrat text-sm mb-3">¿No tienes una cuenta?</p>
            <a href="{{ route('register') }}" 
               class="inline-flex items-center justify-center w-full border-2 border-black text-black hover:bg-black hover:text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-user-plus mr-2"></i>
                {{ __('CREAR CUENTA') }}
            </a>
        </div>
    </form>
</x-guest-layout>
