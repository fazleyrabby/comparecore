<header class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-800 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-10 sticky top-0">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        <div class="hidden sm:block">
            <p class="text-sm text-gray-500 dark:text-gray-400">@yield('title', 'Dashboard')</p>
        </div>
    </div>

    <div class="flex items-center gap-3 sm:gap-5">
        <a href="?theme=dark" class="hidden dark:block text-gray-400 hover:text-gray-200 transition-colors" title="Enable Light Mode">
            <i data-lucide="sun" class="w-5 h-5"></i>
        </a>
        <a href="?theme=light" class="block dark:hidden text-gray-500 hover:text-gray-900 transition-colors" title="Enable Dark Mode">
            <i data-lucide="moon" class="w-5 h-5"></i>
        </a>

        <div class="relative lg:hidden">
            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs dark:bg-indigo-900/50 dark:text-indigo-300">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
        </div>
    </div>
</header>
