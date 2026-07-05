<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $results = collect();

        if (strlen($query) >= 2) {
            $products = Product::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'ilike', "%{$query}%")
                      ->orWhere('description', 'ilike', "%{$query}%");
                })
                ->with(['brand', 'categories'])
                ->limit(10)
                ->get()
                ->map(fn ($item) => [
                    'type' => 'Product',
                    'name' => $item->name,
                    'description' => $item->brand->name . ' · ' . $item->categories->pluck('name')->implode(', '),
                    'url' => route('public.products.show', $item->slug),
                ]);

            $categories = Category::where('is_active', true)
                ->where('name', 'ilike', "%{$query}%")
                ->withCount('products')
                ->limit(5)
                ->get()
                ->map(fn ($item) => [
                    'type' => 'Category',
                    'name' => $item->name,
                    'description' => $item->products_count . ' products',
                    'url' => route('public.categories.show', $item->slug),
                ]);

            $brands = Brand::where('name', 'ilike', "%{$query}%")
                ->withCount('products')
                ->limit(5)
                ->get()
                ->map(fn ($item) => [
                    'type' => 'Brand',
                    'name' => $item->name,
                    'description' => $item->products_count . ' products',
                    'url' => '#',
                ]);

            $results = $products->merge($categories)->merge($brands);
        }

        return view('public.search.index', compact('query', 'results'));
    }
}
