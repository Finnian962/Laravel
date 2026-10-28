<?php

namespace App\Providers\OrderRows;

use App\Models\OrderRow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        OrderRow::create([
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
        ]);

        return redirect()->route('orderrows.index')->with('status', 'De bestelregel is aangemaakt.');
    }
}
