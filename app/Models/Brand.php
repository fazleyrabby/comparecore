<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'website_url',
        'logo_path',
        'description',
    ];

    /**
     * Products belonging to this brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
