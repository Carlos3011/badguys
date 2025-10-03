<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Vanilo\Product\Models\Product;
use Vanilo\Taxonomy\Models\Taxon;

class ProductController extends Controller
{
    // Lista productos
    public function index()
    {
        $products = Product::with('taxons')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    // Formulario create
    public function create()
    {
        $categories = Taxon::where('taxonomy_id', 1)->pluck('name', 'id'); // Ej: categorías de productos
        return view('admin.products.create', compact('categories'));
    }

    // Guardar producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'sku'              => 'required|string|max:50|unique:products,sku',
            'price'            => 'required|numeric|min:0',
            'original_price'   => 'nullable|numeric|min:0',
            'stock'            => 'required|numeric|min:0',
            'excerpt'          => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'state'            => 'required|in:active,inactive',
            'slug'             => 'nullable|string|max:255|unique:products,slug',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_id'      => 'nullable|exists:taxons,id',
            'color'            => 'nullable|string|max:50',
            'size'             => 'nullable|string|max:50',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear producto
        $product = Product::create(array_merge($validated, [
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
        ]));

        // Asignar categoría
        if (!empty($validated['category_id'])) {
            $product->attachTaxons([$validated['category_id']]);
        }

        // Asignar propiedades
        if (!empty($validated['color'])) {
            $product->setProperty('color', $validated['color']);
        }
        if (!empty($validated['size'])) {
            $product->setProperty('size', $validated['size']);
        }

        // Subida de imágenes
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = Str::slug($product->name) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $destination = public_path('products');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $image->move($destination, $filename);
                $images[] = 'products/' . $filename;
            }
            $product->images = $images;
            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    // Formulario edit
    public function edit(Product $product)
    {
        $categories = Taxon::where('taxonomy_id', 1)->pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Actualizar producto
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'sku'              => 'required|string|max:50|unique:products,sku,' . $product->id,
            'price'            => 'required|numeric|min:0',
            'original_price'   => 'nullable|numeric|min:0',
            'stock'            => 'required|numeric|min:0',
            'excerpt'          => 'nullable|string|max:500',
            'description'      => 'nullable|string',
            'state'            => 'required|in:active,inactive',
            'slug'             => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_id'      => 'nullable|exists:taxons,id',
            'color'            => 'nullable|string|max:50',
            'size'             => 'nullable|string|max:50',
            'images.*'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar datos básicos
        $product->update(array_merge($validated, [
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
        ]));

        // Actualizar categoría
        if (!empty($validated['category_id'])) {
            $product->syncTaxons([$validated['category_id']]);
        }

        // Actualizar propiedades
        if (!empty($validated['color'])) {
            $product->setProperty('color', $validated['color']);
        }
        if (!empty($validated['size'])) {
            $product->setProperty('size', $validated['size']);
        }

        // Subida de nuevas imágenes (mantener las anteriores)
        if ($request->hasFile('images')) {
            $images = $product->images ?? [];
            foreach ($request->file('images') as $image) {
                $filename = Str::slug($product->name) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $destination = public_path('products');
                if (!is_dir($destination)) {
                    mkdir($destination, 0755, true);
                }
                $image->move($destination, $filename);
                $images[] = 'products/' . $filename;
            }
            $product->images = $images;
            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Producto eliminado correctamente.');
    }
}