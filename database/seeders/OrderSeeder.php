<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'orderdate' => '2026-01-01',
            'user_id' => 1,
            'status' => 'Hier jouw status',
        ]);
    }
}
