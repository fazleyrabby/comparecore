@extends('public.layouts.app')

@section('title', 'Compare Products')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Compare Products</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Compare up to 4 products side-by-side</p>
    </div>

    @if($products->count() < 2)
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-12 text-center">
        <div class="w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mx-auto mb-4">
            <i data-lucide="git-compare" class="w-8 h-8"></i>
        </div>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Select products to compare</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-6">You need at least 2 products to start comparing.</p>
        <a href="{{ route('public.products') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
            <i data-lucide="search" class="w-4 h-4"></i>
            Browse Products
        </a>
    </div>
    @else
    {{-- Product Headers --}}
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden mb-6">
        <div class="grid" style="grid-template-columns: 200px repeat({{ $products->count() }}, 1fr)">
            {{-- Label Column --}}
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-r border-gray-200 dark:border-gray-800">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Product</span>
            </div>

            {{-- Product Columns --}}
            @foreach($products as $product)
            <div class="p-4 border-b border-gray-200 dark:border-gray-800 {{ !$loop->last ? 'border-r' : '' }}">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="package" class="w-8 h-8 text-indigo-300 dark:text-indigo-700"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                    <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-0.5">{{ $product->brand->name ?? '' }}</p>
                    <button onclick="removeFromCompare('{{ $product->slug }}')" class="mt-2 text-xs text-red-500 hover:text-red-600 dark:hover:text-red-400">Remove</button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Categories Row --}}
        <div class="grid" style="grid-template-columns: 200px repeat({{ $products->count() }}, 1fr)">
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-r border-gray-200 dark:border-gray-800">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Categories</span>
            </div>
            @foreach($products as $product)
            <div class="p-4 border-b border-gray-200 dark:border-gray-800 {{ !$loop->last ? 'border-r' : '' }}">
                <div class="flex flex-wrap gap-1 justify-center">
                    @forelse($product->categories as $cat)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $cat->name }}</span>
                    @empty
                        <span class="text-xs text-gray-400">-</span>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>

        {{-- Tags Row --}}
        <div class="grid" style="grid-template-columns: 200px repeat({{ $products->count() }}, 1fr)">
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-r border-gray-200 dark:border-gray-800">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Tags</span>
            </div>
            @foreach($products as $product)
            <div class="p-4 border-b border-gray-200 dark:border-gray-800 {{ !$loop->last ? 'border-r' : '' }}">
                <div class="flex flex-wrap gap-1 justify-center">
                    @forelse($product->tags as $tag)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400">{{ $tag->name }}</span>
                    @empty
                        <span class="text-xs text-gray-400">-</span>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>

        {{-- Attribute Rows --}}
        @forelse($attributeKeys as $attrKey)
        <div class="grid" style="grid-template-columns: 200px repeat({{ $products->count() }}, 1fr)">
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-b border-r border-gray-200 dark:border-gray-800">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $attrKey)) }}</span>
            </div>
            @foreach($products as $product)
                @php
                    $value = $product->attributes[$attrKey] ?? null;
                    $displayValue = is_array($value) ? implode(', ', $value) : ($value ?? '-');
                    // Check if all products have the same value for highlighting
                    $allValues = $products->pluck("attributes.{$attrKey}")->values();
                    $allSame = $allValues->filter()->isNotEmpty() && $allValues->unique()->count() === 1;
                @endphp
                <div class="p-4 border-b border-gray-200 dark:border-gray-800 {{ !$loop->last ? 'border-r' : '' }}">
                    <span class="text-sm text-center block {{ $allSame ? 'text-gray-400 dark:text-gray-500' : 'font-medium text-gray-900 dark:text-white' }}">
                        {{ $displayValue }}
                    </span>
                </div>
            @endforeach
        </div>
        @empty
        <div class="grid" style="grid-template-columns: 200px repeat({{ $products->count() }}, 1fr)">
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-r border-gray-200 dark:border-gray-800">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Specifications</span>
            </div>
            @foreach($products as $product)
            <div class="p-4 {{ !$loop->last ? 'border-r' : '' }}">
                <span class="text-sm text-gray-400 text-center block">No specifications</span>
            </div>
            @endforeach
        </div>
        @endforelse
    </div>

    {{-- Add More --}}
    <div class="text-center">
        <a href="{{ route('public.products') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add More Products
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function removeFromCompare(slug) {
    let compare = JSON.parse(localStorage.getItem('compare') || '[]');
    compare = compare.filter(p => p.slug !== slug);
    localStorage.setItem('compare', JSON.stringify(compare));
    // Reload with remaining products
    const remaining = compare.map(p => 'products[]=' + encodeURIComponent(p.slug)).join('&');
    window.location.href = '{{ route("public.compare") }}' + (remaining ? '?' + remaining : '');
}
</script>
@endpush
