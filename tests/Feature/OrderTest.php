<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the orders page has a create modal and a delete button per order', function () {
    $order = Order::create([
        'orderdate' => '2026-03-04',
        'user_id' => User::firstOrFail()->id,
        'status' => 'Verwerkt',
    ]);

    $response = $this->get('/orders');

    $response->assertOk();
    $response->assertSee('id="create-order-modal"', false);
    $response->assertSee(route('orders.create'), false);
    $response->assertSee(route('orders.delete', $order), false);
});

test('that an order can be created', function () {
    $this->from('/orders')
        ->post(route('orders.create'), [
            'orderdate' => '2026-05-06',
            'user_id' => User::firstOrFail()->id,
            'status' => 'In behandeling',
        ])
        ->assertRedirect('/orders')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('orders', [
        'orderdate' => '2026-05-06',
        'status' => 'In behandeling',
    ]);
});

test('that creating an order without a date fails validation', function () {
    $count = Order::count();

    $this->from('/orders')
        ->post(route('orders.create'), [
            'orderdate' => '',
            'user_id' => User::firstOrFail()->id,
            'status' => 'In behandeling',
        ])
        ->assertRedirect('/orders')
        ->assertSessionHasErrors('orderdate');

    $this->assertSame($count, Order::count());
});

test('that creating an order without a status fails validation', function () {
    $count = Order::count();

    $this->from('/orders')
        ->post(route('orders.create'), [
            'orderdate' => '2026-05-06',
            'user_id' => User::firstOrFail()->id,
            'status' => '',
        ])
        ->assertRedirect('/orders')
        ->assertSessionHasErrors('status');

    $this->assertSame($count, Order::count());
});

test('that an order without order rows can be deleted', function () {
    $order = Order::create([
        'orderdate' => '2026-06-07',
        'user_id' => User::firstOrFail()->id,
        'status' => 'Tijdelijk',
    ]);

    expect($order->canDelete())->toBeTrue();

    $this->delete(route('orders.delete', $order))
        ->assertRedirect('/orders')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('orders', ['id' => $order->id]);
});

test('that an order with order rows cannot be deleted', function () {
    $order = Order::has('orderrows')->firstOrFail();

    expect($order->canDelete())->toBeFalse();

    $this->delete(route('orders.delete', $order))
        ->assertRedirect('/orders')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('orders', ['id' => $order->id]);
});
