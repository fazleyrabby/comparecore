@extends('public.layouts.app')

@section('title', $query ? "Search: {$query}" : 'Search')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Search Form --}}
    <div class="mb-8">
        <form action="{{ route('public.search') }}" method="GET" class="max-w-2xl">
            <div class="relative">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                <input type="text" name="q" value="{{ $query }}" placeholder="Search products, categories, brands..."
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-white outline-none"
                    autofocus>
            </div>
        </form>
    </div>

    {{-- Results --}}
    @if($query && strlen($query) < 2)
    <div class="text-center py-12">
        <p class="text-gray-500 dark:text-gray-400">Type at least 2 characters to search.</p>
    </div>
    @elseif($query)
    <div class="mb-4">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $results->count() }} result{{ $results->count() !== 1 ? 's' : '' }} for "<span class="font-medium text-gray-900 dark:text-white">{{ $query }}</span>"
        </p>
    </div>

    @if($results->count())
    <div class="space-y-3">
        @foreach($results as $result)
        <a href="{{ $result['url'] }}" class="flex items-center gap-4 p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl hover:shadow-md hover:border-indigo-300 dark:hover:border-indigo-700 transition-all">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0
                {{ $result['type'] === 'Product' ? 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400' :
                   ($result['type'] === 'Category' ? 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400' :
                   'bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400') }}">
                <i data-lucide="{{ $result['type'] === 'Product' ? 'package' : ($result['type'] === 'Category' ? 'folder-tree' : 'building') }}" class="w-5 h-5"></i>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $result['name'] }}</h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                        {{ $result['type'] === 'Product' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400' :
                           ($result['type'] === 'Category' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' :
                           'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400') }}">
                        {{ $result['type'] }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $result['description'] }}</p>
            </div>
            <i data-lucide="arrow-right" class="w-4 h-4 text-gray-400 flex-shrink-0"></i>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="search" class="w-8 h-8 text-gray-400"></i>
        </div>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No results found</h2>
        <p class="text-gray-500 dark:text-gray-400">Try a different search term.</p>
    </div>
    @endif

    @else
    <div class="text-center py-12">
        <div class="w-16 h-16 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="search" class="w-8 h-8 text-indigo-600 dark:text-indigo-400"></i>
        </div>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Search CompareCore</h2>
        <p class="text-gray-500 dark:text-gray-400">Find products, categories, and brands.</p>
    </div>
    @endif
</div>
@endsection
