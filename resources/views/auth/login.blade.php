<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Iniciar sesión') }}</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700" />
            <x-text-input id="email"
                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="space-y-1.5">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700" />
            <x-text-input id="password"
                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                type="password"
                name="password"
                required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black focus:ring-black" name="remember">
                <span class="text-sm text-gray-600">{{ __('Recordarme') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-black hover:underline" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
            {{ __('Iniciar sesión') }}
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">{{ __('¿No tienes una cuenta?') }}</p>
            <a href="{{ route('register') }}" class="text-sm text-black hover:underline">
                {{ __('Crear cuenta') }}
            </a>
        </div>
    </form>
</x-guest-layout>
