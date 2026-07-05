<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required|array|max:10',
            'images.*' => 'image|max:2048',
        ]);

        $existingCount = $product->images()->count();

        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => $existingCount === 0 && $index === 0,
                'sort_order' => $existingCount + $index,
            ]);
        }

        return back()->with('success', 'Images uploaded.');
    }

    public function destroy(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        Storage::disk('public')->delete($image->image_path);

        $wasPrimary = $image->is_primary;
        $image->delete();

        if ($wasPrimary) {
            $first = $product->images()->orderBy('sort_order')->first();
            if ($first) {
                $first->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Image deleted.');
    }

    public function setPrimary(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            abort(404);
        }

        $product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image updated.');
    }

    public function reorder(Request $request, Product $product)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:product_images,id',
        ]);

        foreach ($request->input('order') as $index => $id) {
            ProductImage::where('id', $id)->where('product_id', $product->id)
                ->update(['sort_order' => $index]);
        }

        return back()->with('success', 'Images reordered.');
    }
}
