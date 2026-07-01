<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it can create category hierarchy', function () {
    $parent = Category::create([
        'name' => 'Software',
        'slug' => 'software',
    ]);

    $child = Category::create([
        'name' => 'AI Tools',
        'slug' => 'ai-tools',
        'parent_id' => $parent->id,
    ]);

    expect($child->parent->name)->toBe('Software')
        ->and($parent->children)->toHaveCount(1)
        ->and($parent->children->first()->name)->toBe('AI Tools');
});

test('it can relate brands, products, categories, and tags', function () {
    $brand = Brand::create([
        'name' => 'OpenAI',
        'slug' => 'openai',
        'website_url' => 'https://openai.com',
    ]);

    $category = Category::create([
        'name' => 'AI Chatbots',
        'slug' => 'ai-chatbots',
    ]);

    $tag = Tag::create([
        'name' => 'LLM',
        'slug' => 'llm',
    ]);

    $product = Product::create([
        'brand_id' => $brand->id,
        'name' => 'ChatGPT',
        'slug' => 'chatgpt',
        'description' => 'A conversational AI',
        'status' => 'published',
        'attributes' => [
            'has_api' => true,
            'pricing_model' => 'freemium',
            'context_window' => '128K',
        ],
    ]);

    $product->categories()->attach($category->id, ['is_primary' => true]);
    $product->tags()->attach($tag->id);

    $image = ProductImage::create([
        'product_id' => $product->id,
        'image_path' => 'images/chatgpt.png',
        'is_primary' => true,
        'sort_order' => 1,
    ]);

    // Test relationships
    expect($product->brand->name)->toBe('OpenAI')
        ->and($product->categories->first()->name)->toBe('AI Chatbots')
        ->and($product->tags->first()->name)->toBe('LLM')
        ->and($product->images->first()->image_path)->toBe('images/chatgpt.png')
        ->and($brand->products)->toHaveCount(1)
        ->and($category->products)->toHaveCount(1)
        ->and($tag->products)->toHaveCount(1);
});

test('it can filter products using jsonb attribute query scopes', function () {
    $brand = Brand::create(['name' => 'Google', 'slug' => 'google']);

    $gemini = Product::create([
        'brand_id' => $brand->id,
        'name' => 'Gemini',
        'slug' => 'gemini',
        'attributes' => [
            'has_api' => true,
            'pricing_model' => 'freemium',
            'context_window' => '2M',
        ],
    ]);

    $cursor = Product::create([
        'brand_id' => $brand->id,
        'name' => 'Cursor',
        'slug' => 'cursor',
        'attributes' => [
            'has_api' => false,
            'pricing_model' => 'subscription',
        ],
    ]);

    // Test scopeWithAttribute
    $apiProducts = Product::withAttribute('has_api', true)->get();
    expect($apiProducts)->toHaveCount(1)
        ->and($apiProducts->first()->name)->toBe('Gemini');

    $freemiumProducts = Product::withAttribute('pricing_model', 'freemium')->get();
    expect($freemiumProducts)->toHaveCount(1)
        ->and($freemiumProducts->first()->name)->toBe('Gemini');

    // Test scopeHasAttributeKey
    $contextProducts = Product::hasAttributeKey('context_window')->get();
    expect($contextProducts)->toHaveCount(1)
        ->and($contextProducts->first()->name)->toBe('Gemini');
});
