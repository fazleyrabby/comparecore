@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors mb-2">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Products
    </a>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Product</h2>
</div>

@php
    $productCategoryIds = $product->categories->pluck('id')->toArray();
    $productTagIds = $product->tags->pluck('id')->toArray();
@endphp

<form action="{{ route('admin.products.update', $product) }}" method="POST" class="max-w-3xl">
    @csrf @method('PUT')
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800 p-6 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('name') border-red-300 @enderror">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="brand_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand <span class="text-red-500">*</span></label>
                <select id="brand_id" name="brand_id" required
                    class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('brand_id') border-red-300 @enderror">
                    <option value="">Select brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea id="description" name="description" rows="3"
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('description') border-red-300 @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Categories</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                @foreach($categories as $cat)
                    <label class="flex items-center gap-2 p-2 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition-colors">
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, old('categories', $productCategoryIds)) ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-700">
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $cat->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('categories') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition-colors">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $productTagIds)) ? 'checked' : '' }}
                            class="h-3.5 w-3.5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-700">
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('tags') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status <span class="text-red-500">*</span></label>
            <select id="status" name="status" required
                class="mt-1 block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white @error('status') border-red-300 @enderror">
                <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $product->status) === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Update Product</button>
        <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors">Cancel</a>
    </div>
</form>

{{-- Image Management --}}
<div class="mt-8 max-w-3xl">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Images</h3>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300">
        {{ session('success') }}
    </div>
    @endif

    {{-- Upload Form --}}
    <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-900 dark:border-gray-800 p-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Upload Images</label>
            <input type="file" name="images[]" multiple accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/30 dark:file:text-indigo-400">
            <p class="mt-1 text-xs text-gray-400">Max 10 images, 2MB each. JPG, PNG, WebP.</p>
            <button type="submit" class="mt-3 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">Upload</button>
        </div>
    </form>

    {{-- Existing Images --}}
    @if($product->images->count())
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach($product->images as $image)
        <div class="relative group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm dark:bg-gray-900 dark:border-gray-800">
            <div class="aspect-square">
                <img src="{{ Storage::disk('public')->url($image->image_path) }}" alt="" class="w-full h-full object-cover">
            </div>
            @if($image->is_primary)
            <span class="absolute top-2 left-2 px-2 py-0.5 bg-indigo-600 text-white text-xs font-medium rounded">Primary</span>
            @endif
            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                @unless($image->is_primary)
                <form action="{{ route('admin.products.images.primary', [$product, $image]) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-1.5 bg-white/90 dark:bg-gray-800/90 rounded-lg hover:bg-white dark:hover:bg-gray-800 transition-colors" title="Set primary">
                        <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500"></i>
                    </button>
                </form>
                @endunless
                <form action="{{ route('admin.products.images.destroy', [$product, $image]) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-1.5 bg-white/90 dark:bg-gray-800/90 rounded-lg hover:bg-white dark:hover:bg-gray-800 transition-colors" title="Delete">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5 text-red-500"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-8 bg-white border border-gray-200 rounded-xl dark:bg-gray-900 dark:border-gray-800">
        <i data-lucide="image" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
        <p class="text-sm text-gray-500 dark:text-gray-400">No images yet. Upload some above.</p>
    </div>
    @endif
</div>
@endsection
