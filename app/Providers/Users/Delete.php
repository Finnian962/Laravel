<?php

namespace App\Providers\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(User $user): RedirectResponse
    {
        if (! $user->canDelete()) {
            return redirect()->route('users.index')
                ->with('error', 'De gebruiker kan niet verwijderd worden zolang er reviews of bestellingen aan gekoppeld zijn.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'De gebruiker is verwijderd.');
    }
}
