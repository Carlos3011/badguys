<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['taxons', 'media'])
            ->where('state', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('customer.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['taxons', 'media']);
        return view('customer.products.show', compact('product'));
    }

    public function home(Request $request)
    {
        $products = Product::query()
            ->with(['taxons', 'media'])
            ->where('state', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('customer.home', compact('products'));
    }
}