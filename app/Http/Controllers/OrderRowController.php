<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Order;
use App\Models\OrderRow;
use App\Models\Product;
use App\Providers\OrderRows\Create;
use App\Providers\OrderRows\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderRowController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $orderrows = OrderRow::with(['order', 'product.category'])->get();
        $orders = Order::with('user')->get();
        $products = Product::with('category')->orderBy('name')->get();

        return view('orderrows.index', compact('orderrows', 'orders', 'products'));
    }

    public function get(int $id): OrderRow
    {
        return OrderRow::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $orderrow = OrderRow::findOrFail($id);

        $data = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $orderrow->update($data);

        return redirect()->route('orderrows.index')->with('status', 'De bestelregel is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(OrderRow::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(OrderRow $orderrow): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($orderrow);
    }
}
