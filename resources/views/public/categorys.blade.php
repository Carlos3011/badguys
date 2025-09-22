<x-public-layout>
    <!-- Hero Section -->
    <section class="bg-white py-20 relative overflow-hidden">
        <!-- Background texture -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.02)_1px,transparent_1px)] bg-[size:40px_40px]"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-6xl lg:text-7xl font-wet-paint text-black mb-6 tracking-wide">
                    EXPLORA <span class="text-gray-600">CATEGORÍAS</span>
                </h1>
                <div class="h-2 w-40 bg-black mx-auto mb-8 rounded-full"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-montserrat leading-relaxed">
                    Descubre nuestras colecciones organizadas por estilo. Cada categoría representa una expresión única de la cultura urbana y el streetwear premium.
                </p>
            </div>
        </div>
    </section>

    <!-- Categories Grid Section -->
    <section class="bg-gray-50 py-20 relative overflow-hidden">
        <!-- Background texture -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.02)_1px,transparent_1px)] bg-[size:40px_40px]"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-wet-paint text-gray-900 mb-4">
                    NUESTRAS <span class="text-black">COLECCIONES</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto font-montserrat">
                    Cada categoría ha sido cuidadosamente curada para ofrecerte lo mejor del streetwear y la moda urbana
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                
                <!-- Streetwear Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-tshirt text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">STREETWEAR</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Colección Urbana</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Streetwear Premium</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Hoodies, camisetas oversized, joggers y más. Diseños exclusivos que definen el estilo urbano contemporáneo.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">24 productos</span>
                            <span class="text-black font-semibold">Desde $45.99</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Explorar Colección
                        </button>
                    </div>
                </div>

                <!-- Accesorios Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-hat-cowboy text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">ACCESORIOS</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Estilo Único</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Accesorios Premium</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Gorras, gafas, joyas y más. Complementos que elevan tu look y completan tu estilo personal.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">18 productos</span>
                            <span class="text-black font-semibold">Desde $29.99</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Explorar Colección
                        </button>
                    </div>
                </div>

                <!-- Calzado Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-running text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">CALZADO</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Edición Limitada</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Calzado Exclusivo</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Sneakers, botas y más. Cada paso cuenta con nuestro calzado diseñado para destacar en la ciudad.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">12 productos</span>
                            <span class="text-black font-semibold">Desde $89.99</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Explorar Colección
                        </button>
                    </div>
                </div>

                <!-- Edición Limitada Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-crown text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">LIMITADA</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Exclusiva</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Edición Limitada</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Piezas únicas y exclusivas. Colecciones limitadas que no encontrarás en ningún otro lugar.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">8 productos</span>
                            <span class="text-black font-semibold">Desde $129.99</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Explorar Colección
                        </button>
                    </div>
                </div>

                <!-- Nuevos Lanzamientos Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-fire text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">NUEVOS</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Lanzamientos</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Nuevos Lanzamientos</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Las últimas tendencias y novedades. Sé el primero en lucir los diseños más frescos del mercado.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">15 productos</span>
                            <span class="text-black font-semibold">Desde $39.99</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Explorar Colección
                        </button>
                    </div>
                </div>

                <!-- Ofertas Category -->
                <div class="group bg-white rounded-3xl overflow-hidden border border-gray-200 hover:border-black transition-all duration-500 relative">
                    <div class="aspect-[4/3] bg-gray-100 flex items-center justify-center p-12 relative overflow-hidden">
                        <div class="text-center relative z-10">
                            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-tags text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-wet-paint text-black mb-2">OFERTAS</h3>
                            <p class="text-gray-600 font-montserrat text-sm">Especiales</p>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-xl font-wet-paint text-gray-900 mb-3">Ofertas Especiales</h3>
                        <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                            Descuentos exclusivos y promociones especiales. Aprovecha estas oportunidades únicas.
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500 font-montserrat">20 productos</span>
                            <span class="text-black font-semibold">Hasta 50% OFF</span>
                        </div>
                        <button class="w-full bg-black hover:bg-gray-800 text-white py-3 rounded-xl font-semibold font-montserrat text-sm uppercase tracking-wide transition-all duration-300">
                            Ver Ofertas
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Featured Categories CTA -->
    <section class="bg-gray-50 py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl lg:text-5xl font-wet-paint text-black mb-6">
                    ¿NO ENCUENTRAS LO QUE <span class="text-gray-700">BUSCAS?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8 font-montserrat">
                    Explora nuestro catálogo completo o contáctanos para ayudarte a encontrar el producto perfecto
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-black hover:bg-gray-800 text-white px-8 py-4 rounded-xl font-semibold font-montserrat uppercase tracking-wide transition-all duration-300">
                        Ver Todos los Productos
                    </button>
                    <button class="border-2 border-gray-400 text-gray-700 hover:bg-gray-700 hover:text-white px-8 py-4 rounded-xl font-semibold font-montserrat uppercase tracking-wide transition-all duration-300">
                        Contactar Soporte
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>