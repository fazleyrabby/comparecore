<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name')) – CompareCore</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        body { font-family: 'Inter Var', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

    {{-- Nav --}}
    <nav class="border-b border-gray-200 dark:border-gray-800 sticky top-0 z-30 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                        <i data-lucide="git-compare" class="w-5 h-5 text-indigo-600 dark:text-indigo-500"></i>
                        CompareCore
                    </a>
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('public.categories') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Categories</a>
                        <a href="{{ route('public.products') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Products</a>
                        <a href="{{ route('public.compare') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">Compare</a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{ route('public.search') }}" method="GET" class="hidden sm:block">
                        <div class="relative">
                            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="text" name="q" placeholder="Search..."
                                class="w-48 pl-9 pr-3 py-1.5 text-sm border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-white outline-none">
                        </div>
                    </form>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors">Log in</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-200 dark:border-gray-800 py-8 mt-12">
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
    @include('public.layouts.compare-bar')
    @stack('scripts')
</body>
</html>
