<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-roboto-flex font-bold text-gray-900 mb-2">
            CONFIRMAR <span class="text-black">CONTRASEÑA</span>
        </h2>
        <p class="text-gray-600 font-montserrat text-sm">Por favor confirma tu contraseña antes de continuar</p>
        <div class="h-0.5 w-16 bg-black mx-auto mt-3 rounded-full"></div>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

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
                    placeholder="Ingresa tu contraseña actual" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Button -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full bg-black hover:bg-gray-800 text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-check mr-2"></i>
                {{ __('CONFIRMAR') }}
            </button>
        </div>

        <!-- Back Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 font-montserrat text-sm mb-3">¿Necesitas ayuda?</p>
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-full border-2 border-black text-black hover:bg-black hover:text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('VOLVER AL LOGIN') }}
            </a>
        </div>
    </form>
</x-guest-layout>
