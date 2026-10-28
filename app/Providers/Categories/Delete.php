<?php

namespace App\Providers\Categories;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Category $category): RedirectResponse
    {
        if (! $category->canDelete()) {
            return redirect()->route('categories.index')
                ->with('error', 'De categorie kan niet verwijderd worden zolang er spellen aan gekoppeld zijn.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'De categorie is verwijderd.');
    }
}
