<?php

namespace App\Providers\Categories;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Create
{
    public function create(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        Category::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('categories.index')->with('status', 'De categorie is aangemaakt.');
    }
}
