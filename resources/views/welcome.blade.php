<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompareCore – Compare Products Smarter</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        body { font-family: 'Inter Var', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100">

    {{-- Nav --}}
    <nav class="border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <i data-lucide="git-compare" class="w-6 h-6 text-indigo-600 dark:text-indigo-500"></i>
                    CompareCore
                </a>
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('public.categories') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Categories</a>
                    <a href="{{ route('public.products') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Products</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">Log in</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium dark:bg-indigo-900/30 dark:text-indigo-400 mb-6">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                The "Shopify of Comparison Websites"
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                Compare Products<br class="hidden sm:block"> Smarter, Not Harder
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-10">
                One reusable comparison engine that powers any product vertical – from AI tools and VPNs to hosting and SaaS.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('public.products') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/25">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    Browse Products
                </a>
                <a href="{{ route('public.categories') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <i data-lucide="folder-tree" class="w-4 h-4"></i>
                    Explore Categories
                </a>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    @if($categories->count())
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Browse Categories</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Find the right tools for your needs</p>
                </div>
                <a href="{{ route('public.categories') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">View all &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('public.categories.show', $category->slug) }}" class="group flex items-center gap-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:shadow-lg hover:border-indigo-300 dark:hover:border-indigo-700 transition-all">
                    <div class="w-12 h-12 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                        <i data-lucide="{{ $category->icon ?? 'folder' }}" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->products_count }} products</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Latest Products --}}
    @if($featuredProducts->count())
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Latest Products</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Recently added to CompareCore</p>
                </div>
                <a href="{{ route('public.products') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400">View all &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredProducts as $product)
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
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Ready to Compare?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">Browse products, compare features side-by-side, and find the best tools for your needs.</p>
            <a href="{{ route('public.products') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-500/25">
                <i data-lucide="git-compare" class="w-4 h-4"></i>
                Start Comparing
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 dark:border-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} CompareCore. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('public.categories') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Categories</a>
                <a href="{{ route('public.products') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Products</a>
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Admin</a>
            </div>
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>
