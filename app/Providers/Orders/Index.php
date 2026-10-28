<?php

namespace App\Providers\Orders;

use App\Models\Order;

class Index
{
    public function index()
    {
        $orders = Order::all();

        return $orders->toArray();
    }
}
