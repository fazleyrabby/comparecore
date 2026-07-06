<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'description',
        'rich_content',
        'status',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    /**
     * Brand relation.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Categories relation.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    /**
     * Primary category relation.
     */
    public function primaryCategory()
    {
        return $this->belongsToMany(Category::class, 'product_categories')
            ->wherePivot('is_primary', true)
            ->withTimestamps();
    }

    /**
     * Tags relation.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags')
            ->withTimestamps();
    }

    /**
     * Images relation.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Pricing plans relation.
     */
    public function pricingPlans()
    {
        return $this->hasMany(PricingPlan::class)->orderBy('sort_order');
    }

    public function affiliateLinks()
    {
        return $this->hasMany(AffiliateLink::class)->orderBy('sort_order');
    }

    /**
     * Scope to filter products by a specific dynamic attribute value in JSONB.
     */
    public function scopeWithAttribute($query, string $key, $value)
    {
        return $query->where("attributes->$key", $value);
    }

    /**
     * Scope to filter products by whether they possess a dynamic attribute key.
     */
    public function scopeHasAttributeKey($query, string $key)
    {
        return $query->whereNotNull("attributes->$key");
    }
}
