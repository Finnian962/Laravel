<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [29.99, 34.99, 39.99, 44.99, 49.99, 59.99];

        Product::query()->orderBy('id')->get()->each(function (Product $product, int $index) use ($prices) {
            Price::create([
                'price' => $prices[$index % count($prices)],
                'effdate' => '2026-01-01',
                'product_id' => $product->id,
            ]);
        });
    }
}
