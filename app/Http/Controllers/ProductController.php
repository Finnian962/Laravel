<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Category;
use App\Models\Product;
use App\Providers\Products\Create;
use App\Providers\Products\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $products = Product::with('category')->get();
        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function get(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Het product is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Product::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Product $product): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($product);
    }
}
