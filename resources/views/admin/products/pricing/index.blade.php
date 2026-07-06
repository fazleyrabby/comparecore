@extends('admin.layouts.app')

@section('title', "Pricing — {$product->name}")

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors mb-2">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to {{ $product->name }}
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Pricing Plans</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $product->name }}</p>
        </div>
        <a href="{{ route('admin.products.pricing.create', $product) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i> Add Plan
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300">
    {{ session('success') }}
</div>
@endif

<div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200 dark:bg-gray-800/50 dark:text-gray-400 dark:border-gray-800">
                <tr>
                    <th class="px-6 py-3 font-medium">Name</th>
                    <th class="px-6 py-3 font-medium">Price</th>
                    <th class="px-6 py-3 font-medium">Billing</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                @forelse($plans as $plan)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $plan->name }}</td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $plan->formatted_price }}</span>
                        @if($plan->original_price && $plan->original_price > $plan->price)
                            <span class="ml-2 text-xs text-gray-400 line-through">${{ number_format($plan->original_price, 2) }}</span>
                            <span class="ml-1 text-xs font-medium text-green-600 dark:text-green-400">-{{ $plan->discount_percent }}%</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400 capitalize">{{ str_replace('_', ' ', $plan->billing_cycle) }}</td>
                    <td class="px-6 py-4">
                        @if($plan->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.pricing.edit', [$product, $plan]) }}" class="p-1.5 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.pricing.destroy', [$product, $plan]) }}" method="POST" onsubmit="return confirm('Delete this plan?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No pricing plans yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
