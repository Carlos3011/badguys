<x-public-layout>
    <!-- Hero Section -->
    <section class="bg-black py-20 relative overflow-hidden">
        <!-- Enhanced background patterns -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gray-800/20"></div>
            <div class="absolute top-0 left-0 w-full h-full bg-gray-900/10"></div>
            
            <!-- Animated grid pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center">
                <h1 class="text-6xl lg:text-7xl font-wet-paint text-white mb-6 tracking-wide">
                    CATÁLOGO <span class="text-gray-300">COMPLETO</span>
                </h1>
                <div class="h-2 w-40 bg-white mx-auto mb-8 rounded-full"></div>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto font-montserrat leading-relaxed">
                    Explora toda nuestra colección de productos exclusivos. Desde streetwear hasta accesorios premium, encuentra tu estilo único.
                </p>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="bg-white py-8 border-b border-gray-200 sticky top-16 z-40">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Category Filters -->
                <div class="flex flex-wrap gap-3">
                    <button class="px-6 py-2 bg-black text-white rounded-full font-montserrat font-semibold text-sm hover:bg-gray-800 transition-colors duration-200 shadow-md">
                        Todos
                    </button>
                    <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-montserrat font-medium text-sm hover:bg-gray-200 transition-colors duration-200">
                        Streetwear
                    </button>
                    <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-montserrat font-medium text-sm hover:bg-gray-200 transition-colors duration-200">
                        Accesorios
                    </button>
                    <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-montserrat font-medium text-sm hover:bg-gray-200 transition-colors duration-200">
                        Calzado
                    </button>
                    <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full font-montserrat font-medium text-sm hover:bg-gray-200 transition-colors duration-200">
                        Edición Limitada
                    </button>
                </div>
                
                <!-- Search and Sort -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Buscar productos..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg font-montserrat text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg font-montserrat text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                        <option>Ordenar por</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                        <option>Más Populares</option>
                        <option>Más Recientes</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid Section -->
    <section class="bg-white py-16 relative overflow-hidden">
        <!-- Background texture -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.02)_1px,transparent_1px)] bg-[size:40px_40px]"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />

                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />
                <x-public.card-produtc 
                    title="Gorra Snapback"
                    description="Bordado premium con logo metálico"
                    price="$45.99"
                    icon="fas fa-hat-cowboy"
                    category="ACCESORIOS"
                    categoryDescription="Estilo Único"
                    buttonText="Agregar"
                    href="#"
                />


            </div>
        </div>
    </section>

    <!-- Pagination Section -->
    <section class="bg-white py-12 border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex justify-center items-center space-x-2">
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 font-montserrat">
                    <i class="fas fa-chevron-left mr-2"></i>Anterior
                </button>
                
                <button class="px-4 py-2 bg-black text-white rounded-lg font-montserrat font-semibold">1</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 font-montserrat">2</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 font-montserrat">3</button>
                <span class="px-2 text-gray-500">...</span>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 font-montserrat">12</button>
                
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors duration-200 font-montserrat">
                    Siguiente<i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>
            
            <div class="text-center mt-6">
                <p class="text-gray-600 font-montserrat text-sm">
                    Mostrando <span class="font-semibold">1-8</span> de <span class="font-semibold">96</span> productos
                </p>
            </div>
        </div>
    </section>
</x-public-layout>