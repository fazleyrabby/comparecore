<div x-data="compareBar()" x-show="items.length > 0" x-transition
    class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 shadow-lg">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    <span x-text="items.length"></span>/4 products selected
                </span>
                <div class="flex items-center gap-2">
                    <template x-for="item in items" :key="item.slug">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400">
                            <span x-text="item.name"></span>
                            <button @click="remove(item.slug)" class="ml-0.5 hover:text-indigo-900 dark:hover:text-indigo-200">&times;</button>
                        </span>
                    </template>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="clear()" class="px-3 py-1.5 text-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">Clear</button>
                <a :href="compareUrl()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    <i data-lucide="git-compare" class="w-3.5 h-3.5"></i>
                    Compare Now
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function compareBar() {
    return {
        items: JSON.parse(localStorage.getItem('compare') || '[]'),
        init() {
            window.addEventListener('compare-updated', () => {
                this.items = JSON.parse(localStorage.getItem('compare') || '[]');
            });
        },
        remove(slug) {
            this.items = this.items.filter(p => p.slug !== slug);
            localStorage.setItem('compare', JSON.stringify(this.items));
            window.dispatchEvent(new Event('compare-updated'));
        },
        clear() {
            this.items = [];
            localStorage.setItem('compare', '[]');
            window.dispatchEvent(new Event('compare-updated'));
        },
        compareUrl() {
            const params = this.items.map(p => 'products[]=' + encodeURIComponent(p.slug)).join('&');
            return '{{ route("public.compare") }}?' + params;
        }
    };
}
</script>
