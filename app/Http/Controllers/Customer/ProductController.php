<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Vanilo\Category\Models\Taxon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with(['taxons', 'media'])->where('state', 'active');

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $categoryId = (int) $request->get('category');
            $query->whereHas('taxons', function ($tax) use ($categoryId) {
                $tax->where('id', $categoryId)->where('taxonomy_id', 1);
            });
        }

        $sort = $request->get('sort');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = Taxon::where('taxonomy_id', 1)->orderBy('name')->get();

        return view('customer.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['taxons', 'media']);
        return view('customer.products.show', compact('product'));
    }

    public function home(Request $request)
    {
        $query = Product::query()->with(['taxons', 'media'])->where('state', 'active');

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $categoryId = (int) $request->get('category');
            $query->whereHas('taxons', function ($tax) use ($categoryId) {
                $tax->where('id', $categoryId)->where('taxonomy_id', 1);
            });
        }

        $sort = $request->get('sort');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = Taxon::where('taxonomy_id', 1)->orderBy('name')->get();

        return view('customer.home', compact('products', 'categories'));
    }
}