<?php

namespace App\Http\Controllers;

use App\Providers\Auth\Login;
use App\Providers\Auth\Logout;
use App\Providers\Auth\Show;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show(): View
    {
        $show = new Show;

        return $show->show();
    }

    public function login(Request $request): RedirectResponse
    {
        $login = new Login;

        return $login->login($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        $logout = new Logout;

        return $logout->logout($request);
    }
}
