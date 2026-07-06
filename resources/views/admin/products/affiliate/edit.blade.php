@extends('admin.layouts.app')

@section('title', "Edit Affiliate Link — {$product->name}")

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.affiliate.index', $product) }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors mb-2">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Affiliate Links
    </a>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Affiliate Link</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $product->name }}</p>
</div>

<form action="{{ route('admin.products.affiliate.update', [$product, $link]) }}" method="POST" class="max-w-2xl">
    @csrf @method('PUT')
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800 p-6 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $link->name) }}" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('name') border-red-300 @enderror">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="network" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Network <span class="text-red-500">*</span></label>
                <select name="network" id="network" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('network') border-red-300 @enderror">
                    @foreach(['direct', 'impact', 'partnerstack', 'cj', 'shareasale'] as $net)
                        <option value="{{ $net }}" {{ old('network', $link->network) === $net ? 'selected' : '' }}>{{ ucfirst($net) }}</option>
                    @endforeach
                </select>
                @error('network') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Affiliate URL <span class="text-red-500">*</span></label>
            <input type="url" name="url" id="url" value="{{ old('url', $link->url) }}" required
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('url') border-red-300 @enderror">
            @error('url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="fallback_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fallback URL</label>
            <input type="url" name="fallback_url" id="fallback_url" value="{{ old('fallback_url', $link->fallback_url) }}"
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('fallback_url') border-red-300 @enderror">
            @error('fallback_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="campaign_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Campaign ID</label>
                <input type="text" name="campaign_id" id="campaign_id" value="{{ old('campaign_id', $link->campaign_id) }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
            <div>
                <label for="coupon_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coupon Code</label>
                <input type="text" name="coupon_code" id="coupon_code" value="{{ old('coupon_code', $link->coupon_code) }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="deep_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deep Link</label>
                <input type="text" name="deep_link" id="deep_link" value="{{ old('deep_link', $link->deep_link) }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
            <div>
                <label for="commission_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Commission Rate (%)</label>
                <input type="number" step="0.01" name="commission_rate" id="commission_rate" value="{{ old('commission_rate', $link->commission_rate) }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
        </div>

        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $link->is_active) ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-700">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Update Link</button>
        <a href="{{ route('admin.products.affiliate.index', $product) }}" class="px-5 py-2.5 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">Cancel</a>
    </div>
</form>
@endsection
