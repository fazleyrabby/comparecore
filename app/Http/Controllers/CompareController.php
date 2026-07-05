<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $slugs = $request->query('products', []);
        $slugs = array_slice(array_filter($slugs), 0, 4);

        $products = collect();
        if (!empty($slugs)) {
            $products = Product::whereIn('slug', $slugs)
                ->with(['brand', 'categories', 'tags'])
                ->get();
        }

        // Collect all unique attribute keys
        $attributeKeys = collect();
        $products->each(function ($product) use ($attributeKeys) {
            if ($product->attributes) {
                foreach (array_keys($product->attributes) as $key) {
                    $attributeKeys->push($key);
                }
            }
        });
        $attributeKeys = $attributeKeys->unique()->sort()->values();

        return view('public.compare.index', compact('products', 'attributeKeys'));
    }
}
