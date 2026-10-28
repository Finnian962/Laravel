<?php

namespace App\Providers\OrderRows;

use App\Models\OrderRow;

class Index
{
    public function index()
    {
        $orderrows = OrderRow::all();

        return $orderrows->toArray();
    }
}
