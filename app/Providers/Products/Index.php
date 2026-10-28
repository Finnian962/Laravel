<?php

namespace App\Providers\Products;

use App\Models\Product;

class Index
{
    public function index()
    {
        $products = Product::all();

        return $products->toArray();
    }
}
