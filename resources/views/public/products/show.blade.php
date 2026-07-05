@extends('public.layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="{{ route('public.products') }}" class="hover:text-gray-700 dark:hover:text-gray-200">Products</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-gray-900 dark:text-white font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Product Header --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden">
                @if($product->images->count())
                <div class="h-64 bg-gray-100 dark:bg-gray-800">
                    <img src="{{ Storage::disk('public')->url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                @if($product->images->count() > 1)
                <div class="flex gap-2 p-4 overflow-x-auto">
                    @foreach($product->images as $image)
                    <img src="{{ Storage::disk('public')->url($image->image_path) }}" alt="" class="w-16 h-16 rounded-lg object-cover flex-shrink-0 {{ $loop->first ? 'ring-2 ring-indigo-500' : 'opacity-60 hover:opacity-100' }}">
                    @endforeach
                </div>
                @endif
                @else
                <div class="h-48 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                    <i data-lucide="package" class="w-20 h-20 text-indigo-300 dark:text-indigo-700"></i>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        @if($product->brand)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                            {{ $product->brand->name }}
                        </span>
                        @endif
                        @if($product->status === 'published')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Published</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Draft</span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $product->name }}</h1>
                    @if($product->description)
                    <p class="text-gray-600 dark:text-gray-400 mt-3">{{ $product->description }}</p>
                    @endif
                </div>
            </div>

            {{-- Attributes --}}
            @if($product->attributes && count($product->attributes))
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Specifications</h2>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($product->attributes as $key => $value)
                    <div class="px-6 py-3 flex items-center justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Brand --}}
            @if($product->brand)
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Brand</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <i data-lucide="building" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $product->brand->name }}</p>
                        @if($product->brand->website_url)
                        <a href="{{ $product->brand->website_url }}" target="_blank" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Visit website &rarr;</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Categories --}}
            @if($product->categories->count())
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->categories as $cat)
                    <a href="{{ route('public.categories.show', $cat->slug) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Tags --}}
            @if($product->tags->count())
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Tags</h3>
                <div class="flex flex-wrap gap-1.5">
                    @foreach($product->tags as $tag)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Actions --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Actions</h3>
                <div class="space-y-2">
                    @if($product->brand && $product->brand->website_url)
                    <a href="{{ $product->brand->website_url }}" target="_blank" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Visit Website
                    </a>
                    @endif
                    <button onclick="addToCompare('{{ $product->slug }}', '{{ $product->name }}')" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <i data-lucide="git-compare" class="w-4 h-4"></i>
                        Add to Compare
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count())
    <div class="mt-12">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <a href="{{ route('public.products.show', $related->slug) }}" class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden hover:shadow-lg hover:border-indigo-300 dark:hover:border-indigo-700 transition-all">
                <div class="h-32 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                    <i data-lucide="package" class="w-10 h-10 text-indigo-300 dark:text-indigo-700"></i>
                </div>
                <div class="p-4">
                    <span class="text-xs font-medium text-indigo-600 dark:text-indigo-400">{{ $related->brand->name ?? '' }}</span>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors mt-1">{{ $related->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function addToCompare(slug, name) {
    let compare = JSON.parse(localStorage.getItem('compare') || '[]');
    if (compare.length >= 4) {
        alert('You can compare up to 4 products at a time.');
        return;
    }
    if (compare.find(p => p.slug === slug)) {
        alert('This product is already in your compare list.');
        return;
    }
    compare.push({ slug, name });
    localStorage.setItem('compare', JSON.stringify(compare));
    window.dispatchEvent(new Event('compare-updated'));
    // Re-init lucide icons for the compare bar
    if (typeof lucide !== 'undefined') lucide.createIcons();
}
</script>
@endpush
