<?php

namespace App\Http\Controllers;

use App\Models\AffiliateLink;
use App\Models\Product;

class AffiliateClickController extends Controller
{
    public function go(Product $product, AffiliateLink $link)
    {
        $link->increment('clicks');

        return redirect($link->url);
    }
}
