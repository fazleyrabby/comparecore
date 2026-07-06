<?php

use App\Http\Controllers\Admin\AffiliateLinkController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AffiliateClickController;
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
Route::get('/go/{product:slug}/{link}', [AffiliateClickController::class, 'go'])->name('public.affiliate.go');

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
    Route::resource('tags', TagController::class);

    Route::get('products/{product}/pricing', [PricingPlanController::class, 'index'])->name('products.pricing.index');
    Route::get('products/{product}/pricing/create', [PricingPlanController::class, 'create'])->name('products.pricing.create');
    Route::post('products/{product}/pricing', [PricingPlanController::class, 'store'])->name('products.pricing.store');
    Route::get('products/{product}/pricing/{plan}/edit', [PricingPlanController::class, 'edit'])->name('products.pricing.edit');
    Route::put('products/{product}/pricing/{plan}', [PricingPlanController::class, 'update'])->name('products.pricing.update');
    Route::delete('products/{product}/pricing/{plan}', [PricingPlanController::class, 'destroy'])->name('products.pricing.destroy');

    Route::post('products/{product}/images', [ProductImageController::class, 'store'])->name('products.images.store');
    Route::delete('products/{product}/images/{image}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::post('products/{product}/images/{image}/primary', [ProductImageController::class, 'setPrimary'])->name('products.images.primary');
    Route::post('products/{product}/images/reorder', [ProductImageController::class, 'reorder'])->name('products.images.reorder');

    Route::get('products/{product}/affiliate', [AffiliateLinkController::class, 'index'])->name('products.affiliate.index');
    Route::get('products/{product}/affiliate/create', [AffiliateLinkController::class, 'create'])->name('products.affiliate.create');
    Route::post('products/{product}/affiliate', [AffiliateLinkController::class, 'store'])->name('products.affiliate.store');
    Route::get('products/{product}/affiliate/{link}/edit', [AffiliateLinkController::class, 'edit'])->name('products.affiliate.edit');
    Route::put('products/{product}/affiliate/{link}', [AffiliateLinkController::class, 'update'])->name('products.affiliate.update');
    Route::delete('products/{product}/affiliate/{link}', [AffiliateLinkController::class, 'destroy'])->name('products.affiliate.destroy');
});
