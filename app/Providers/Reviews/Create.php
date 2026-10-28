<?php

namespace App\Providers\Reviews;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        Review::create([
            'comment' => $data['comment'],
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
        ]);

        return redirect()->route('reviews.index')->with('status', 'De review is aangemaakt.');
    }
}
