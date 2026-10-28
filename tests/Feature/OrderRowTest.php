<?php

use App\Models\Order;
use App\Models\OrderRow;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the order rows page has a create modal and a delete button per order row', function () {
    $orderrow = OrderRow::firstOrFail();

    $response = $this->get('/orderrows');

    $response->assertOk();
    $response->assertSee('id="create-orderrow-modal"', false);
    $response->assertSee(route('orderrows.create'), false);
    $response->assertSee(route('orderrows.delete', $orderrow), false);
});

test('that an order row can be created', function () {
    $count = OrderRow::count();

    $this->from('/orderrows')
        ->post(route('orderrows.create'), [
            'order_id' => Order::firstOrFail()->id,
            'product_id' => Product::firstOrFail()->id,
        ])
        ->assertRedirect('/orderrows')
        ->assertSessionHas('status');

    $this->assertSame($count + 1, OrderRow::count());
});

test('that creating an order row without an order fails validation', function () {
    $count = OrderRow::count();

    $this->from('/orderrows')
        ->post(route('orderrows.create'), [
            'order_id' => '',
            'product_id' => Product::firstOrFail()->id,
        ])
        ->assertRedirect('/orderrows')
        ->assertSessionHasErrors('order_id');

    $this->assertSame($count, OrderRow::count());
});

test('that creating an order row with an unknown product fails validation', function () {
    $count = OrderRow::count();

    $this->from('/orderrows')
        ->post(route('orderrows.create'), [
            'order_id' => Order::firstOrFail()->id,
            'product_id' => Product::max('id') + 1,
        ])
        ->assertRedirect('/orderrows')
        ->assertSessionHasErrors('product_id');

    $this->assertSame($count, OrderRow::count());
});

test('that an order row can be deleted', function () {
    $orderrow = OrderRow::firstOrFail();

    expect($orderrow->canDelete())->toBeTrue();

    $this->delete(route('orderrows.delete', $orderrow))
        ->assertRedirect('/orderrows')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('orderrows', ['id' => $orderrow->id]);
});
