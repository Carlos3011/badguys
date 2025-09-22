<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-wet-paint text-gray-900 mb-2">
            RESTABLECER <span class="text-black">CONTRASEÑA</span>
        </h2>
        <p class="text-gray-600 font-montserrat text-sm">Crea una nueva contraseña segura</p>
        <div class="h-0.5 w-16 bg-black mx-auto mt-3 rounded-full"></div>
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
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all duration-200 font-montserrat bg-gray-50 focus:bg-white" 
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
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all duration-200 font-montserrat bg-gray-50 focus:bg-white"
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
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:border-black transition-all duration-200 font-montserrat bg-gray-50 focus:bg-white"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Repite tu nueva contraseña" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Reset Password Button -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full bg-black hover:bg-gray-800 text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-key mr-2"></i>
                {{ __('RESTABLECER CONTRASEÑA') }}
            </button>
        </div>

        <!-- Back to Login -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 font-montserrat text-sm mb-3">¿Recordaste tu contraseña?</p>
            <a href="{{ route('login') }}" 
               class="inline-flex items-center justify-center w-full border-2 border-black text-black hover:bg-black hover:text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('VOLVER AL LOGIN') }}
            </a>
        </div>
    </form>
</x-guest-layout>
