<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Confirmar contraseña') }}</h2>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

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

        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
            {{ __('Confirmar') }}
        </button>

        <div class="text-center">
            <p class="text-sm text-gray-600">{{ __('¿Necesitas ayuda?') }}</p>
            <a href="{{ route('login') }}" class="text-sm text-black hover:underline">{{ __('Volver al login') }}</a>
        </div>
    </form>
</x-guest-layout>
