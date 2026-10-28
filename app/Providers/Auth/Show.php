<?php

namespace App\Providers\Auth;

use Illuminate\View\View;

class Show
{
    public function show(): View
    {
        return view('auth.login');
    }
}
