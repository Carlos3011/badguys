<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanilo\Category\Models\Taxonomy;
use Vanilo\Category\Models\Taxon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // List all categories (taxons)
    public function index()
    {
        $taxons = Taxon::with('taxonomy')->orderBy('taxonomy_id')->paginate(10);
        
        // Agregar el conteo de productos para cada taxon
        $taxons->getCollection()->transform(function ($taxon) {
            $taxon->products_count = \DB::table('model_taxons')
                ->where('taxon_id', $taxon->id)
                ->where('model_type', 'App\Models\Product')
                ->count();
            return $taxon;
        });
        
        return view('admin.categories.index', compact('taxons'));
    }

    // Show form to create a category
    public function create()
    {
        $taxonomies = Taxonomy::all();
        $taxons = Taxon::all();
        return view('admin.categories.create', compact('taxonomies', 'taxons'));
    }

    // Store a new category (Taxon)
    public function store(Request $request)
    {
        $request->validate([
            'taxonomy_id' => 'required|exists:taxonomies,id',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:taxons,id',
        ]);

        Taxon::create([
            'taxonomy_id' => $request->taxonomy_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Edit category
    public function edit(Taxon $category)
    {
        $taxonomies = Taxonomy::all();
        $taxons = Taxon::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'taxonomies', 'taxons'));
    }

    // Update category
    public function update(Request $request, Taxon $category)
    {
        $request->validate([
            'taxonomy_id' => 'required|exists:taxonomies,id',
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:taxons,id',
        ]);

        $category->update([
            'taxonomy_id' => $request->taxonomy_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Taxon $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
