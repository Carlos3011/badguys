<x-guest-layout>
    <!-- Page Title -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-roboto-flex font-bold text-gray-900 mb-2">
            VERIFICAR <span class="text-black">EMAIL</span>
        </h2>
        <p class="text-gray-600 font-montserrat text-sm">Revisa tu correo electrónico para verificar tu cuenta</p>
        <div class="h-0.5 w-16 bg-black mx-auto mt-3 rounded-full"></div>
    </div>

    <!-- Verification Message -->
    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-6">
        <div class="flex items-start">
            <i class="fas fa-envelope text-black text-xl mt-1 mr-4"></i>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 font-montserrat mb-2">
                    Verifica tu dirección de correo electrónico
                </h3>
                <p class="text-gray-600 font-montserrat text-sm leading-relaxed">
                    Gracias por registrarte. Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, con gusto te enviaremos otro.
                </p>
            </div>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <p class="text-green-700 font-montserrat text-sm">
                    Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
                </p>
            </div>
        </div>
    @endif

    <div class="space-y-4">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" 
                class="w-full bg-black hover:bg-gray-800 text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-paper-plane mr-2"></i>
                {{ __('REENVIAR EMAIL DE VERIFICACIÓN') }}
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="w-full border-2 border-black text-black hover:bg-black hover:text-white font-montserrat font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                <i class="fas fa-sign-out-alt mr-2"></i>
                {{ __('CERRAR SESIÓN') }}
            </button>
        </form>
    </div>
</x-guest-layout>
