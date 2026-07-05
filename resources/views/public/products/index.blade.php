@extends('public.layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Products</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Browse all products</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <a href="{{ route('public.products.show', $product->slug) }}" class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden hover:shadow-lg hover:border-indigo-300 dark:hover:border-indigo-700 transition-all">
            <div class="h-40 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                <i data-lucide="package" class="w-12 h-12 text-indigo-300 dark:text-indigo-700"></i>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-medium text-indigo-600 dark:text-indigo-400">{{ $product->brand->name ?? '' }}</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ $product->description }}</p>
                @if($product->categories->count())
                <div class="flex flex-wrap gap-1 mt-3">
                    @foreach($product->categories->take(2) as $cat)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $cat->name }}</span>
                    @endforeach
                </div>
                @endif
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">No products found.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection
