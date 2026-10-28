<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'comment' => 'Hier jouw review',
            'user_id' => 1,
            'product_id' => 1,
        ]);
    }
}
