<?php

namespace App\Providers\Products;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('products.index')->with('status', 'Het product is aangemaakt.');
    }
}
