<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateLink;
use App\Models\Product;
use Illuminate\Http\Request;

class AffiliateLinkController extends Controller
{
    public function index(Product $product)
    {
        $links = $product->affiliateLinks()->get();

        return view('admin.products.affiliate.index', compact('product', 'links'));
    }

    public function create(Product $product)
    {
        return view('admin.products.affiliate.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:1000',
            'fallback_url' => 'nullable|url|max:1000',
            'network' => 'required|in:direct,impact,partnerstack,cj,shareasale',
            'campaign_id' => 'nullable|string|max:255',
            'deep_link' => 'nullable|string|max:500',
            'coupon_code' => 'nullable|string|max:100',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        $data['product_id'] = $product->id;
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $product->affiliateLinks()->count();

        AffiliateLink::create($data);

        return redirect()->route('admin.products.affiliate.index', $product)->with('success', 'Affiliate link created.');
    }

    public function edit(Product $product, AffiliateLink $link)
    {
        return view('admin.products.affiliate.edit', compact('product', 'link'));
    }

    public function update(Request $request, Product $product, AffiliateLink $link)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:1000',
            'fallback_url' => 'nullable|url|max:1000',
            'network' => 'required|in:direct,impact,partnerstack,cj,shareasale',
            'campaign_id' => 'nullable|string|max:255',
            'deep_link' => 'nullable|string|max:500',
            'coupon_code' => 'nullable|string|max:100',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $link->update($data);

        return redirect()->route('admin.products.affiliate.index', $product)->with('success', 'Affiliate link updated.');
    }

    public function destroy(Product $product, AffiliateLink $link)
    {
        $link->delete();

        return redirect()->route('admin.products.affiliate.index', $product)->with('success', 'Affiliate link deleted.');
    }
}
