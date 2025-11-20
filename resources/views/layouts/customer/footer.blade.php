<footer class="bg-black border-t border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div class="text-white font-roboto-flex font-bold tracking-wider">BIGI.NYC</div>
            <nav class="flex items-center gap-6 text-sm">
                <a href="{{ route('customer.home') }}" class="text-white/80 hover:text-white transition">Inicio</a>
                <a href="{{ route('customer.products.index') }}" class="text-white/80 hover:text-white transition">Productos</a>
                <a href="{{ route('categorias') }}" class="text-white/80 hover:text-white transition">Categorías</a>
                <a href="{{ route('contacto') }}" class="text-white/80 hover:text-white transition">Contacto</a>
            </nav>
            <div class="text-white/60 text-sm">© {{ date('Y') }} BIGI.NYC</div>
        </div>
    </div>
</footer>