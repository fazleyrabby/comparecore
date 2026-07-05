@extends('public.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Categories</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Browse products by category</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <a href="{{ route('public.categories.show', $category->slug) }}" class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 hover:shadow-lg hover:border-indigo-300 dark:hover:border-indigo-700 transition-all">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <i data-lucide="{{ $category->icon ?? 'folder' }}" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->products_count }} products</p>
                </div>
            </div>

            @if($category->children->count())
            <div class="flex flex-wrap gap-1.5 mt-3">
                @foreach($category->children->take(5) as $child)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                        {{ $child->name }} <span class="ml-1 text-gray-400">({{ $child->products_count }})</span>
                    </span>
                @endforeach
                @if($category->children->count() > 5)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-500">+{{ $category->children->count() - 5 }} more</span>
                @endif
            </div>
            @endif
        </a>
        @empty
        <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">No categories found.</div>
        @endforelse
    </div>
</div>
@endsection
