<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-black">{{ __('Verificar email') }}</h2>
    </div>

    <p class="text-sm text-gray-700 mb-4 text-center">
        {{ __('Te enviamos un correo con un enlace para verificar tu cuenta. Si no lo recibiste, puedes solicitar otro a continuación.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <p class="text-sm text-green-700 text-center mb-4">
            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
        </p>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg hover:bg-black/90 transition-colors">
                {{ __('Reenviar email de verificación') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full border border-gray-300 text-black py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>
