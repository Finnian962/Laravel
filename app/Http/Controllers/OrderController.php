<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Order;
use App\Models\User;
use App\Providers\Orders\Create;
use App\Providers\Orders\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $orders = Order::with('user')->get();
        $users = User::orderBy('name')->get();

        return view('orders.index', compact('orders', 'users'));
    }

    public function get(int $id): Order
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'orderdate' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', 'string', 'max:45'],
        ]);

        $order->update($data);

        return redirect()->route('orders.index')->with('status', 'De bestelling is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Order::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Order $order): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($order);
    }
}
