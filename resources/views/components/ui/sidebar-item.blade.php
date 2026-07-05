@props([
    'href' => '#',
    'active' => false,
    'badge' => null,
    'badgeColor' => 'red',
    'isSubItem' => false,
])

@php
    if ($isSubItem) {
        $baseClasses = 'flex items-center gap-3 py-1.5 px-3 rounded-md text-[13px] transition-all duration-200 group outline-none focus-visible:ring-2 focus-visible:ring-indigo-500';
        $activeClasses = $active
            ? 'text-gray-900 font-semibold dark:text-white'
            : 'text-gray-500 font-medium hover:text-gray-900 dark:text-gray-400 dark:hover:text-white';
    } else {
        $baseClasses = 'flex items-center gap-3 py-2 px-3 rounded-lg text-[13px] font-medium transition-all duration-200 group outline-none focus-visible:ring-2 focus-visible:ring-indigo-500';
        $activeClasses = $active
            ? 'bg-gray-900 text-white dark:bg-gray-100 dark:text-gray-900 shadow-sm'
            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-100';
    }
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $activeClasses]) }}>
    @if(isset($icon))
        <span class="{{ $active ? ($isSubItem ? 'text-gray-900 dark:text-white' : 'text-white dark:text-gray-900') : 'text-gray-400 group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-300' }} transition-colors">
            {{ $icon }}
        </span>
    @endif

    <span class="flex-1 truncate">{{ $slot }}</span>

    @if($badge)
        <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold rounded-full {{ $badgeColor === 'red' ? 'bg-red-500 text-white dark:bg-red-500/20 dark:text-red-400' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
            {{ $badge }}
        </span>
    @endif
</a>
