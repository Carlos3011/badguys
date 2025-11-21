<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Recuperar contraseña') }}</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700" />
            <x-text-input id="email"
                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-black focus:border-black"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
            {{ __('Enviar enlace de recuperación') }}
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">{{ __('¿Recordaste tu contraseña?') }}</p>
            <a href="{{ route('login') }}" class="text-sm text-black hover:underline">{{ __('Volver al login') }}</a>
        </div>
    </form>
</x-guest-layout>
