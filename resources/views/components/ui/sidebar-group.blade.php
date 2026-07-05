@props(['label', 'badge' => null, 'badgeColor' => 'orange'])

<div class="pt-3 pb-1 px-3 flex items-center justify-between">
    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">{{ $label }}</span>
    @if($badge)
        <span class="text-[9px] font-bold uppercase tracking-wide {{ $badgeColor === 'orange' ? 'text-orange-500 dark:text-orange-400' : 'text-gray-500' }}">
            {{ $badge }}
        </span>
    @endif
</div>
