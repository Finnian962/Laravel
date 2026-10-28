<?php

namespace App\Providers\Prices;

use App\Models\Price;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'effdate' => ['required', 'date'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        Price::create([
            'price' => $data['price'],
            'effdate' => $data['effdate'],
            'product_id' => $data['product_id'],
        ]);

        return redirect()->route('prices.index')->with('status', 'De prijs is aangemaakt.');
    }
}
