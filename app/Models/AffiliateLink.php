<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateLink extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'url',
        'fallback_url',
        'network',
        'campaign_id',
        'deep_link',
        'coupon_code',
        'commission_rate',
        'is_active',
        'sort_order',
        'clicks',
    ];

    protected $casts = [
        'commission_rate' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'clicks' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getDisplayUrlAttribute(): string
    {
        return route('public.affiliate.go', [$this->product, $this]);
    }

    public function getNetworkLabelAttribute(): string
    {
        return match ($this->network) {
            'direct' => 'Direct',
            default => ucfirst($this->network),
        };
    }
}
