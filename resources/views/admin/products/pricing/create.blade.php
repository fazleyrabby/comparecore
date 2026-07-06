@extends('admin.layouts.app')

@section('title', "Add Pricing Plan — {$product->name}")

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.pricing.index', $product) }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors mb-2">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Pricing
    </a>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Add Pricing Plan</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $product->name }}</p>
</div>

<form action="{{ route('admin.products.pricing.store', $product) }}" method="POST" class="max-w-2xl">
    @csrf
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800 p-6 space-y-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plan Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('name') border-red-300 @enderror"
                placeholder="e.g. Pro, Enterprise, Starter">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('price') border-red-300 @enderror"
                    placeholder="0.00">
                @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="original_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Original Price</label>
                <input type="number" step="0.01" name="original_price" id="original_price" value="{{ old('original_price') }}"
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('original_price') border-red-300 @enderror"
                    placeholder="Strikethrough price">
                @error('original_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Currency <span class="text-red-500">*</span></label>
                <select name="currency" id="currency" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('currency') border-red-300 @enderror">
                    <option value="USD" {{ old('currency', 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                    <option value="EUR" {{ old('currency') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                    <option value="GBP" {{ old('currency') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                    <option value="BDT" {{ old('currency') === 'BDT' ? 'selected' : '' }}>BDT (৳)</option>
                </select>
                @error('currency') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="billing_cycle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Billing Cycle <span class="text-red-500">*</span></label>
                <select name="billing_cycle" id="billing_cycle" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('billing_cycle') border-red-300 @enderror">
                    @foreach(['monthly', 'yearly', 'lifetime', 'one_time', 'usage', 'credits', 'free', 'trial', 'custom'] as $cycle)
                        <option value="{{ $cycle }}" {{ old('billing_cycle', 'monthly') === $cycle ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $cycle)) }}</option>
                    @endforeach
                </select>
                @error('billing_cycle') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('description') border-red-300 @enderror"
                placeholder="What's included in this plan">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') === '1' ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-700">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
            </label>
        </div>
    </div>

    <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Create Plan</button>
        <a href="{{ route('admin.products.pricing.index', $product) }}" class="px-5 py-2.5 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">Cancel</a>
    </div>
</form>
@endsection
