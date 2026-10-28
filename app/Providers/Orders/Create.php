<?php

namespace App\Providers\Orders;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'orderdate' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', 'string', 'max:45'],
        ]);

        Order::create([
            'orderdate' => $data['orderdate'],
            'user_id' => $data['user_id'],
            'status' => $data['status'],
        ]);

        return redirect()->route('orders.index')->with('status', 'De bestelling is aangemaakt.');
    }
}
