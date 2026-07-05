<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->where('is_active', true);
                $q->withCount('products');
            }])
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('public.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load(['children' => function ($q) {
            $q->where('is_active', true);
            $q->withCount('products');
        }]);

        $products = Product::whereHas('categories', fn ($q) => $q->where('categories.id', $category->id))
            ->with(['brand', 'categories', 'images'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('public.categories.show', compact('category', 'products'));
    }
}
