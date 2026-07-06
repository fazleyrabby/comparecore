<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PricingPlanController extends Controller
{
    public function index(Product $product)
    {
        $plans = $product->pricingPlans()->get();

        return view('admin.products.pricing.index', compact('product', 'plans'));
    }

    public function create(Product $product)
    {
        return view('admin.products.pricing.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gte:price',
            'currency' => 'required|string|max:3',
            'billing_cycle' => 'required|in:monthly,yearly,lifetime,one_time,usage,credits,free,trial,custom',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $data['product_id'] = $product->id;
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $product->pricingPlans()->count();

        $plan = PricingPlan::create($data);

        if ($plan->price) {
            $plan->history()->create([
                'price' => $plan->price,
                'original_price' => $plan->original_price,
            ]);
        }

        return redirect()->route('admin.products.pricing.index', $product)->with('success', 'Pricing plan created.');
    }

    public function edit(Product $product, PricingPlan $plan)
    {
        return view('admin.products.pricing.edit', compact('product', 'plan'));
    }

    public function update(Request $request, Product $product, PricingPlan $plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gte:price',
            'currency' => 'required|string|max:3',
            'billing_cycle' => 'required|in:monthly,yearly,lifetime,one_time,usage,credits,free,trial,custom',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $priceChanged = $plan->price != $data['price'];

        $plan->update($data);

        if ($priceChanged && $data['price']) {
            $plan->history()->create([
                'price' => $data['price'],
                'original_price' => $data['original_price'],
            ]);
        }

        return redirect()->route('admin.products.pricing.index', $product)->with('success', 'Pricing plan updated.');
    }

    public function destroy(Product $product, PricingPlan $plan)
    {
        $plan->delete();

        return redirect()->route('admin.products.pricing.index', $product)->with('success', 'Pricing plan deleted.');
    }
}
