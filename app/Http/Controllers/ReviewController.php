<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Providers\Reviews\Create;
use App\Providers\Reviews\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $reviews = Review::with(['user', 'product.category'])->get();
        $users = User::orderBy('name')->get();
        $products = Product::with('category')->orderBy('name')->get();

        return view('reviews.index', compact('reviews', 'users', 'products'));
    }

    public function get(int $id): Review
    {
        return Review::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);

        $data = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $review->update($data);

        return redirect()->route('reviews.index')->with('status', 'De review is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Review::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Review $review): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($review);
    }
}
