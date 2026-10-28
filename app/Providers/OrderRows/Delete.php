<?php

namespace App\Providers\OrderRows;

use App\Models\OrderRow;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(OrderRow $orderrow): RedirectResponse
    {
        $orderrow->delete();

        return redirect()->route('orderrows.index')->with('status', 'De bestelregel is verwijderd.');
    }
}
