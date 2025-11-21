<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Crear cuenta') }}</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Nombre Completo')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <x-text-input id="name" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="Tu nombre completo" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <x-text-input id="email" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username"
                    placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <x-text-input id="password" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                    type="password"
                    name="password"
                    required 
                    autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <x-text-input id="password_confirmation" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Repite tu contraseña" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start space-x-3">
            <input id="terms" 
                type="checkbox" 
                class="mt-1 rounded border-gray-300 text-black shadow-sm focus:ring-black focus:ring-2 transition-all duration-200" 
                name="terms" 
                required>
            <label for="terms" class="text-sm text-gray-600 font-montserrat leading-relaxed">
                Acepto los 
                <a href="#" class="text-black hover:text-gray-700 font-medium hover:underline">Términos y Condiciones</a> 
                y la 
                <a href="#" class="text-black hover:text-gray-700 font-medium hover:underline">Política de Privacidad</a> 
                de BIGI.NYC
            </label>
        </div>

        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
            {{ __('Crear cuenta') }}
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}" class="text-sm text-black hover:underline">Iniciar sesión</a>
        </div>
    </form>
</x-guest-layout>
