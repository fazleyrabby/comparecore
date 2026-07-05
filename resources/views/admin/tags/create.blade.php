@extends('admin.layouts.app')

@section('title', 'Create Tag')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tags.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Tags
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800">
    <div class="p-6 border-b border-gray-200 dark:border-gray-800">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Create Tag</h2>
    </div>

    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        <div class="p-6 space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white outline-none"
                    placeholder="e.g. cloud, saas, ai">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-800 flex justify-end gap-3">
            <a href="{{ route('admin.tags.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Create Tag</button>
        </div>
    </form>
</div>
@endsection
