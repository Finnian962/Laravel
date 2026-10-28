<?php

namespace Database\Seeders;

use App\Models\OrderRow;
use Illuminate\Database\Seeder;

class OrderRowSeeder extends Seeder
{
    public function run(): void
    {
        OrderRow::create([
            'order_id' => 1,
            'product_id' => 1,
        ]);
    }
}
