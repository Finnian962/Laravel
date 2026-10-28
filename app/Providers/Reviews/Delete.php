<?php

namespace App\Providers\Reviews;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('reviews.index')->with('status', 'De review is verwijderd.');
    }
}
