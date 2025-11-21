<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Restablecer contraseña') }}</h2>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <x-text-input id="email" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black" 
                    type="email" 
                    name="email" 
                    :value="old('email', $request->email)" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Nueva Contraseña')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
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
            <x-input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" class="text-gray-700 font-montserrat font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <x-text-input id="password_confirmation" 
                    class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Repite tu nueva contraseña" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
            {{ __('Restablecer contraseña') }}
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">{{ __('¿Recordaste tu contraseña?') }}</p>
            <a href="{{ route('login') }}" class="text-sm text-black hover:underline">{{ __('Volver al login') }}</a>
        </div>
    </form>
</x-guest-layout>
