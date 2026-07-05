<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', function () {
    $featuredProducts = \App\Models\Product::where('status', 'published')
        ->with(['brand', 'categories'])
        ->latest()
        ->limit(6)
        ->get();

    $categories = \App\Models\Category::where('is_active', true)
        ->whereNull('parent_id')
        ->withCount('products')
        ->orderBy('name')
        ->limit(6)
        ->get();

    return view('welcome', compact('featuredProducts', 'categories'));
});

Route::get('/categories', [CategoryController::class, 'index'])->name('public.categories');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('public.categories.show');
Route::get('/products', [ProductController::class, 'index'])->name('public.products');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('public.products.show');
Route::get('/compare', [CompareController::class, 'index'])->name('public.compare');
Route::get('/search', [SearchController::class, 'index'])->name('public.search');

// Admin Auth
Route::middleware('redirect.admin')->prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);
});
