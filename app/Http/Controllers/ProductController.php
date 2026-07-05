<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'published')
            ->with(['brand', 'categories', 'images'])
            ->latest()
            ->paginate(12);

        return view('public.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['brand', 'categories', 'tags', 'images']);

        $relatedProducts = Product::where('status', 'published')
            ->where('id', '!=', $product->id)
            ->whereHas('categories', fn ($q) => $q->whereIn('categories.id', $product->categories->pluck('id')))
            ->with(['brand', 'categories', 'images'])
            ->limit(4)
            ->get();

        return view('public.products.show', compact('product', 'relatedProducts'));
    }
}
