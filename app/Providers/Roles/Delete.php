<?php

namespace App\Providers\Roles;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Role $role): RedirectResponse
    {
        if (! $role->canDelete()) {
            return redirect()->route('roles.index')
                ->with('error', 'De rol kan niet verwijderd worden zolang er gebruikers aan gekoppeld zijn.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('status', 'De rol is verwijderd.');
    }
}
