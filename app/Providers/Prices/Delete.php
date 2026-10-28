<?php

namespace App\Providers\Prices;

use App\Models\Price;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Price $price): RedirectResponse
    {
        $price->delete();

        return redirect()->route('prices.index')->with('status', 'De prijs is verwijderd.');
    }
}
