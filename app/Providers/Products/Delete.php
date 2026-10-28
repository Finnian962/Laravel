<?php

namespace App\Providers\Products;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class Delete
{
    public function delete(Product $product): RedirectResponse
    {
        if (! $product->canDelete()) {
            return redirect()->route('products.index')
                ->with('error', 'Het product kan niet verwijderd worden zolang er prijzen, reviews of bestelregels aan gekoppeld zijn.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('status', 'Het product is verwijderd.');
    }
}
