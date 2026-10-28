<?php

namespace App\Providers\Roles;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        Role::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('roles.index')->with('status', 'De rol is aangemaakt.');
    }
}
