<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingHistory extends Model
{
    protected $fillable = [
        'pricing_plan_id',
        'price',
        'original_price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
    ];

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }
}
