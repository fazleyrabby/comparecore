@php
    $menu = [
        [
            'type' => 'group',
            'label' => 'Main',
        ],
        [
            'type' => 'item',
            'label' => 'Dashboard',
            'icon' => 'home',
            'route' => route('admin.dashboard'),
            'pattern' => ['admin/dashboard*', 'admin'],
        ],
        [
            'type' => 'group',
            'label' => 'Content',
        ],
        [
            'type' => 'item',
            'label' => 'Products',
            'icon' => 'package',
            'route' => route('admin.products.index'),
            'pattern' => 'admin/products*',
        ],
        [
            'type' => 'item',
            'label' => 'Categories',
            'icon' => 'folder-tree',
            'route' => route('admin.categories.index'),
            'pattern' => 'admin/categories*',
        ],
        [
            'type' => 'item',
            'label' => 'Brands',
            'icon' => 'building',
            'route' => route('admin.brands.index'),
            'pattern' => 'admin/brands*',
        ],
        [
            'type' => 'item',
            'label' => 'Tags',
            'icon' => 'tags',
            'route' => '#',
            'pattern' => 'admin/tags*',
        ],
        [
            'type' => 'group',
            'label' => 'Engines',
        ],
        [
            'type' => 'item',
            'label' => 'Compare',
            'icon' => 'git-compare',
            'route' => '#',
            'pattern' => 'admin/compare*',
        ],
    ];
@endphp

<aside class="flex-shrink-0 w-64 bg-white border-r border-gray-200 dark:bg-gray-900 dark:border-gray-800 flex flex-col transition-all duration-300 z-20 absolute inset-y-0 left-0 lg:static lg:block"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full lg:translate-x-0': !sidebarOpen}">

    <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-gray-800">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <i data-lucide="git-compare" class="w-6 h-6 text-indigo-600 dark:text-indigo-500"></i>
            CompareCore
        </a>
    </div>

    <div class="flex-1 overflow-y-auto scrollbar-thin px-3 py-4 space-y-1">
        @foreach($menu as $item)
            @if(($item['type'] ?? '') === 'group')
                <x-ui.sidebar-group :label="$item['label']" />
            @elseif(($item['type'] ?? '') === 'item')
                <x-ui.sidebar-item
                    :href="$item['route']"
                    :active="request()->is($item['pattern'])"
                    :badge="$item['badge'] ?? null">
                    <x-slot:icon>
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                    </x-slot:icon>
                    {{ $item['label'] }}
                </x-ui.sidebar-item>
            @endif
        @endforeach
    </div>

    <div class="p-4 border-t border-gray-200 dark:border-gray-800">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400 flex items-center justify-center font-bold text-sm flex-shrink-0">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate capitalize">{{ auth()->user()->role ?? 'Admin' }}</p>
            </div>
            <form action="{{ route('logout') }}" method="post" class="flex-shrink-0">
                @csrf
                <button title="Logout" class="p-1 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
<div x-show="sidebarOpen" class="fixed inset-0 bg-gray-900/50 z-10 lg:hidden" @click="sidebarOpen = false" x-transition.opacity></div>
