<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Price;
use App\Models\Product;
use App\Providers\Prices\Create;
use App\Providers\Prices\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PriceController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $prices = Price::with('product.category')->get();
        $products = Product::with('category')->orderBy('name')->get();

        return view('prices.index', compact('prices', 'products'));
    }

    public function get(int $id): Price
    {
        return Price::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $price = Price::findOrFail($id);

        $data = $request->validate([
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'effdate' => ['required', 'date'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $price->update($data);

        return redirect()->route('prices.index')->with('status', 'De prijs is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Price::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Price $price): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($price);
    }
}
