@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Overview of your platform</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 dark:bg-gray-900 dark:border-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</h3>
            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                <i data-lucide="package" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ number_format($stats['total_products']) }}
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 dark:bg-gray-900 dark:border-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Categories</h3>
            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400">
                <i data-lucide="folder-tree" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ number_format($stats['total_categories']) }}
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 dark:bg-gray-900 dark:border-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Brands</h3>
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400">
                <i data-lucide="building" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ number_format($stats['total_brands']) }}
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 dark:bg-gray-900 dark:border-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Tags</h3>
            <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 dark:bg-amber-900/50 dark:text-amber-400">
                <i data-lucide="tags" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ number_format($stats['total_tags']) }}
        </div>
    </div>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 dark:bg-gray-900 dark:border-gray-800">
    <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">Getting Started</h3>
    <p class="text-sm text-gray-500 dark:text-gray-400">Welcome to CompareCore. Start by adding products, categories, and brands to build your comparison platform.</p>
</div>
@endsection
