<?php

use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the prices page has a create modal and a delete button per price', function () {
    $price = Price::firstOrFail();

    $response = $this->get('/prices');

    $response->assertOk();
    $response->assertSee('id="create-price-modal"', false);
    $response->assertSee(route('prices.create'), false);
    $response->assertSee(route('prices.delete', $price), false);
});

test('that a price can be created', function () {
    $product = Product::firstOrFail();

    $this->from('/prices')
        ->post(route('prices.create'), [
            'price' => 12.5,
            'effdate' => '2026-06-01',
            'product_id' => $product->id,
        ])
        ->assertRedirect('/prices')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('prices', [
        'price' => 12.5,
        'effdate' => '2026-06-01',
        'product_id' => $product->id,
    ]);
});

test('that creating a price without an effdate fails validation', function () {
    $product = Product::firstOrFail();
    $count = Price::count();

    $this->from('/prices')
        ->post(route('prices.create'), [
            'price' => 12.5,
            'effdate' => '',
            'product_id' => $product->id,
        ])
        ->assertRedirect('/prices')
        ->assertSessionHasErrors('effdate');

    $this->assertSame($count, Price::count());
});

test('that creating a price for an unknown product fails validation', function () {
    $count = Price::count();

    $this->from('/prices')
        ->post(route('prices.create'), [
            'price' => 12.5,
            'effdate' => '2026-06-01',
            'product_id' => Product::max('id') + 1,
        ])
        ->assertRedirect('/prices')
        ->assertSessionHasErrors('product_id');

    $this->assertSame($count, Price::count());
});

test('that a price can be deleted', function () {
    $price = Price::firstOrFail();

    expect($price->canDelete())->toBeTrue();

    $this->delete(route('prices.delete', $price))
        ->assertRedirect('/prices')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('prices', ['id' => $price->id]);
});
