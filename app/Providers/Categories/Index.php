<?php

namespace App\Providers\Categories;

use App\Models\Category;

class Index
{
    public function index()
    {
        $categories = Category::all();

        return $categories->toArray();
    }
}
