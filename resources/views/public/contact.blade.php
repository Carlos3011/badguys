<x-public-layout>
    <!-- Hero Section -->
    <section class="bg-white py-24 relative overflow-hidden">
        <!-- Simple background pattern -->
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-6xl lg:text-7xl font-roboto-flex font-bold text-black mb-8 tracking-wide">
                    CONTÁCTANOS
                </h1>
                <div class="h-2 w-40 bg-black mx-auto mb-10 rounded-full"></div>
                <p class="text-xl lg:text-2xl text-gray-600 font-montserrat leading-relaxed mb-8">
                    ¿Tienes alguna pregunta? ¿Necesitas ayuda con tu pedido? Estamos aquí para ayudarte.
                </p>
                <p class="text-lg text-gray-700 font-montserrat italic">
                    "Tu opinión nos importa, tu satisfacción es nuestra prioridad"
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info Section -->
    <section class="bg-gray-50 py-20 relative overflow-hidden">
        <!-- Background texture -->
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-12 border border-gray-200 relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-3xl lg:text-4xl font-roboto-flex font-bold  text-gray-900 mb-8">
                            ENVÍANOS UN <span class="text-black">MENSAJE</span>
                        </h2>
                        
                        <form class="space-y-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">Nombre Completo</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-black focus:ring-0 transition-colors duration-300 font-montserrat"
                                    placeholder="Tu nombre completo">
                            </div>
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">Correo Electrónico</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-black focus:ring-0 transition-colors duration-300 font-montserrat"
                                    placeholder="tu@email.com">
                            </div>
                            
                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">Teléfono (Opcional)</label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-black focus:ring-0 transition-colors duration-300 font-montserrat"
                                    placeholder="+1 (555) 123-4567">
                            </div>
                            
                            <!-- Subject Field -->
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">Asunto</label>
                                <select id="subject" name="subject" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-black focus:ring-0 transition-colors duration-300 font-montserrat">
                                    <option value="">Selecciona un asunto</option>
                                    <option value="general">Consulta General</option>
                                    <option value="order">Estado de Pedido</option>
                                    <option value="return">Devoluciones y Cambios</option>
                                    <option value="product">Información de Producto</option>
                                    <option value="collaboration">Colaboraciones</option>
                                    <option value="other">Otro</option>
                                </select>
                            </div>
                            
                            <!-- Message Field -->
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2 font-montserrat">Mensaje</label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-black focus:ring-0 transition-colors duration-300 font-montserrat resize-none"
                                    placeholder="Cuéntanos cómo podemos ayudarte..."></textarea>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" 
                                class="w-full bg-black hover:bg-gray-800 text-white px-8 py-4 rounded-xl font-semibold font-montserrat uppercase tracking-wide transition-all duration-300 shadow-lg">
                                Enviar Mensaje
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="space-y-8">
                    <!-- Contact Details -->
                    <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-200 relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-roboto-flex font-bold text-gray-900 mb-6">
                                INFORMACIÓN DE <span class="text-black">CONTACTO</span>
                            </h3>
                            
                            <div class="space-y-6">
                               
                
                                
                                <!-- Email -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 font-montserrat mb-1">Email</h4>
                                        <p class="text-gray-600 font-montserrat">info@BIGI.NYC.com</p>
                                        <p class="text-gray-600 font-montserrat">support@BIGI.NYC.com</p>
                                    </div>
                                </div>
                                
                                <!-- Hours -->
                                {{-- <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-clock text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 font-montserrat mb-1">Horarios</h4>
                                        <p class="text-gray-600 font-montserrat">
                                            Lun - Vie: 9:00 AM - 6:00 PM<br>
                                            Sáb: 10:00 AM - 4:00 PM<br>
                                            Dom: Cerrado
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Methods Section -->
    <section class="bg-gray-50 py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-roboto-flex font-bold text-black mb-6">
                    MÉTODOS DE <span class="text-gray-600">PAGO</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-montserrat">
                    Información sobre nuestros métodos de pago seguros y confiables
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Payment Item 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                                <i class="fab fa-paypal text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-black font-montserrat">¿Cómo funciona el pago con PayPal?</h3>
                        </div>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </button>
                    <div class="px-8 pb-6">
                        <p class="text-gray-600 font-montserrat leading-relaxed">
                            PayPal es nuestro método de pago principal. Es 100% seguro y te permite pagar con tu cuenta PayPal, tarjeta de débito o crédito. No necesitas crear una cuenta PayPal para completar tu compra.
                        </p>
                    </div>
                </div>

                <!-- Payment Item 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-black font-montserrat">¿Es seguro pagar con PayPal?</h3>
                        </div>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </button>
                    <div class="px-8 pb-6">
                        <p class="text-gray-600 font-montserrat leading-relaxed">
                            Absolutamente. PayPal utiliza encriptación de nivel bancario y protección contra fraudes. Tus datos financieros nunca se comparten con nosotros, garantizando máxima seguridad en cada transacción.
                        </p>
                    </div>
                </div>

                <!-- Payment Item 3 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                                <i class="fas fa-credit-card text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-black font-montserrat">¿Qué tarjetas acepta PayPal?</h3>
                        </div>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </button>
                    <div class="px-8 pb-6">
                        <p class="text-gray-600 font-montserrat leading-relaxed">
                            A través de PayPal puedes usar Visa, Mastercard, American Express, Discover y tarjetas de débito. También aceptamos pagos desde cuentas bancarias vinculadas a PayPal.
                        </p>
                    </div>
                </div>

                <!-- Payment Item 4 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-black font-montserrat">¿Cuándo se procesa mi pago?</h3>
                        </div>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </button>
                    <div class="px-8 pb-6">
                        <p class="text-gray-600 font-montserrat leading-relaxed">
                            Tu pago se procesa inmediatamente al confirmar la compra. Recibirás una confirmación por email de PayPal y nuestra tienda. El pedido se prepara para envío en las siguientes 24 horas.
                        </p>
                    </div>
                </div>

                <!-- Payment Item 5 -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                                <i class="fas fa-undo text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-black font-montserrat">¿Cómo funcionan los reembolsos?</h3>
                        </div>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </button>
                    <div class="px-8 pb-6">
                        <p class="text-gray-600 font-montserrat leading-relaxed">
                            Los reembolsos se procesan automáticamente a tu método de pago original a través de PayPal. Generalmente tardan 3-5 días hábiles en reflejarse en tu cuenta o tarjeta.
                        </p>
                    </div>
                </div>

                <!-- PayPal Trust Badge -->
                <div class="mt-12 text-center">
                    <div class="inline-flex items-center space-x-4 bg-white rounded-2xl px-8 py-6 border border-gray-200 shadow-sm">
                        <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center">
                            <i class="fab fa-paypal text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <h4 class="text-black font-semibold font-montserrat text-lg">Protegido por PayPal</h4>
                            <p class="text-gray-600 font-montserrat text-sm">Compra con confianza y seguridad garantizada</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-black text-xl"></i>
                            <span class="text-black font-montserrat font-semibold">Verificado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>