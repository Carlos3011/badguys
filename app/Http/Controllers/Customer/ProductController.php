<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Vanilo\Category\Models\Taxon;

class ProductController extends Controller
{
    public function home(Request $request)
    {
        $query = Product::query()->with(['taxons', 'media']);

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        $categoryId = $request->filled('category') ? (int) $request->get('category') : null;
        $brandId = $request->filled('brand') ? (int) $request->get('brand') : null;
        if ($categoryId || $brandId) {
            $query->where(function ($sub) use ($categoryId, $brandId) {
                if ($categoryId) {
                    $sub->whereHas('taxons', function ($tax) use ($categoryId) {
                        $tax->where('id', $categoryId)->where('taxonomy_id', 1);
                    });
                }
                if ($brandId) {
                    $sub->orWhereHas('taxons', function ($tax) use ($brandId) {
                        $tax->where('id', $brandId)->where('taxonomy_id', 2);
                    });
                }
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

        if ($query->count() === 0) {
            $query = Product::query()->with(['taxons', 'media']);
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        }

        $perPage = $request->get('per_page', 'all');
        if ($perPage === 'all') {
            $products = $query->get();
        } else {
            $perPage = is_numeric($perPage) ? max(1, min((int) $perPage, 72)) : 12;
            $products = $query->paginate($perPage)->appends($request->query());
        }
        $categories = Taxon::where('taxonomy_id', 1)->orderBy('name')->get();

        return view('customer.home', compact('products', 'categories'));
    }
    
    public function index(Request $request)
    {
        $query = Product::query()->with(['taxons', 'media']);

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        $categoryId = $request->filled('category') ? (int) $request->get('category') : null;
        $brandId = $request->filled('brand') ? (int) $request->get('brand') : null;
        if ($categoryId || $brandId) {
            $query->where(function ($sub) use ($categoryId, $brandId) {
                if ($categoryId) {
                    $sub->whereHas('taxons', function ($tax) use ($categoryId) {
                        $tax->where('id', $categoryId)->where('taxonomy_id', 1);
                    });
                }
                if ($brandId) {
                    $sub->orWhereHas('taxons', function ($tax) use ($brandId) {
                        $tax->where('id', $brandId)->where('taxonomy_id', 2);
                    });
                }
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

        if ($query->count() === 0) {
            $query = Product::query()->with(['taxons', 'media']);
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        }

        $perPage = $request->get('per_page', 'all');
        if ($perPage === 'all') {
            $products = $query->get();
        } else {
            $perPage = is_numeric($perPage) ? max(1, min((int) $perPage, 72)) : 12;
            $products = $query->paginate($perPage)->appends($request->query());
        }
        $categories = Taxon::where('taxonomy_id', 1)->orderBy('name')->get();

        return view('customer.products.index', compact('products', 'categories'));
    }

    

    public function show(Product $product)
    {
        $product->load(['taxons', 'media']);

        return view('customer.products.show', compact('product'));
    }
}
