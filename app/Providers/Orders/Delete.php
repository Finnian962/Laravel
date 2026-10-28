<?php

namespace App\Providers\Orders;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Order $order): RedirectResponse
    {
        if (! $order->canDelete()) {
            return redirect()->route('orders.index')
                ->with('error', 'De bestelling kan niet verwijderd worden zolang er bestelregels aan gekoppeld zijn.');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('status', 'De bestelling is verwijderd.');
    }
}
