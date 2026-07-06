<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'price',
        'original_price',
        'currency',
        'billing_cycle',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function history()
    {
        return $this->hasMany(PricingHistory::class)->latest();
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->billing_cycle === 'free') return 'Free';
        if ($this->billing_cycle === 'custom') return 'Custom';
        if (is_null($this->price)) return '-';

        $symbol = match ($this->currency) {
            'EUR' => '€',
            'GBP' => '£',
            'BDT' => '৳',
            default => '$',
        };

        return $symbol . number_format($this->price, 2);
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if (!$this->original_price || !$this->price || $this->original_price <= $this->price) {
            return null;
        }

        return (int) round((1 - $this->price / $this->original_price) * 100);
    }
}
