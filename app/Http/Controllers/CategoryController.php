<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Category;
use App\Providers\Categories\Create;
use App\Providers\Categories\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $categories = Category::withCount('products')->get();
        $category->load('products.prices');

        return view('categories.show', compact('category', 'categories'));
    }

    public function get(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('status', 'De categorie is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Category::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Category $category): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($category);
    }
}
