<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Vanilo\Category\Models\Taxon;
use Vanilo\Properties\Models\Property;
use Vanilo\Properties\Models\PropertyValue;

class ProductController extends Controller
{
    // Mostrar lista de productos
    public function index()
    {
        $products = Product::with('taxons', 'propertyValues')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categories = Taxon::where('taxonomy_id', 1)->get(); // categorías
        $brands     = Taxon::where('taxonomy_id', 2)->get(); // marcas
        $seasons    = Taxon::where('taxonomy_id', 3)->get(); // temporadas
        $properties = Property::all();

        return view('admin.products.create', compact('categories', 'brands', 'seasons', 'properties'));
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'sku'        => 'required|string|unique:products,sku',
            'price'      => 'nullable|numeric',
            'stock'      => 'nullable|numeric',
            'state'      => 'nullable|string',
            'category'   => 'nullable|exists:taxons,id',
            'brand'      => 'nullable|exists:taxons,id',
            'season'     => 'nullable|exists:taxons,id',
            'properties' => 'nullable|array',
            'images'     => 'required|array|min:1|max:4',
            'images.*'   => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/webp|max:4096',
        ]);

        // Crear producto
        $product = Product::create([
            'name'  => $request->name,
            'sku'   => $request->sku,
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
            'state' => $request->state ?? 'draft',
        ]);

        // Asociar taxons
        $taxonIds = array_filter([$request->category, $request->brand, $request->season]);
        if (!empty($taxonIds)) {
            $product->taxons()->sync($taxonIds);
        }

        // Asignar propiedades
        if ($request->filled('properties')) {
            $product->assignPropertyValues($request->properties);
        }

        // Subir imágenes múltiples
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('default');
            }
        } else {
            return redirect()->back()->withErrors(['images' => 'Debe subir al menos una imagen del producto.']);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Product $product)
    {
        $categories = Taxon::where('taxonomy_id', 1)->get();
        $brands     = Taxon::where('taxonomy_id', 2)->get();
        $seasons    = Taxon::where('taxonomy_id', 3)->get();
        $properties = Property::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'seasons', 'properties'));
    }

    // Actualizar producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'sku'        => 'required|string|unique:products,sku,' . $product->id,
            'price'      => 'nullable|numeric',
            'stock'      => 'nullable|numeric',
            'state'      => 'nullable|string',
            'category'   => 'nullable|exists:taxons,id',
            'brand'      => 'nullable|exists:taxons,id',
            'season'     => 'nullable|exists:taxons,id',
            'properties' => 'nullable|array',
            'images'     => 'nullable|array|max:4',
            'images.*'   => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/webp|max:4096',
        ]);

        $product->update([
            'name'  => $request->name,
            'sku'   => $request->sku,
            'price' => $request->price ?? 0,
            'stock' => $request->stock ?? 0,
            'state' => $request->state ?? $product->state,
        ]);

        // Sincronizar taxons
        $taxonIds = array_filter([$request->category, $request->brand, $request->season]);
        $product->taxons()->sync($taxonIds);

        // Reemplazar propiedades
        if ($request->filled('properties')) {
            $product->replacePropertyValuesByScalar($request->properties);
        }

        // Subir nuevas imágenes si existen
        if ($request->hasFile('images')) {
            $product->clearMediaCollection('default');
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('default');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    // Mostrar detalles de un producto
    public function show(Product $product)
    {
        $product->load('taxons', 'propertyValues');
        $images = $product->getMedia('default');

        return view('admin.products.show', compact('product', 'images'));
    }
}
