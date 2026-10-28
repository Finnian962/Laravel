<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the products page has a create modal and a delete button per product', function () {
    $category = Category::firstOrFail();
    $withoutPrices = Product::create([
        'name' => 'Verwijderbaar product',
        'description' => 'Een product zonder prijzen, reviews of bestelregels.',
        'category_id' => $category->id,
    ]);
    $withPrices = Product::firstOrFail();

    $response = $this->get('/products');

    $response->assertOk();
    $response->assertSee('id="create-product-modal"', false);
    $response->assertSee(route('products.create'), false);
    $response->assertSee(route('products.delete', $withoutPrices), false);
    $response->assertDontSee(route('products.delete', $withPrices), false);
});

test('that a product can be created', function () {
    $category = Category::firstOrFail();

    $this->from('/products')
        ->post(route('products.create'), [
            'name' => 'Vers product',
            'description' => 'Een product dat net is aangemaakt.',
            'category_id' => $category->id,
        ])
        ->assertRedirect('/products')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('products', [
        'name' => 'Vers product',
        'description' => 'Een product dat net is aangemaakt.',
        'category_id' => $category->id,
    ]);
});

test('that creating a product without a name fails validation', function () {
    $category = Category::firstOrFail();
    $count = Product::count();

    $this->from('/products')
        ->post(route('products.create'), [
            'name' => '',
            'description' => 'Een beschrijving.',
            'category_id' => $category->id,
        ])
        ->assertRedirect('/products')
        ->assertSessionHasErrors('name');

    $this->assertSame($count, Product::count());
});

test('that creating a product without a category fails validation', function () {
    $count = Product::count();

    $this->from('/products')
        ->post(route('products.create'), [
            'name' => 'Product zonder categorie',
            'description' => 'Een beschrijving.',
            'category_id' => Category::max('id') + 1,
        ])
        ->assertRedirect('/products')
        ->assertSessionHasErrors('category_id');

    $this->assertSame($count, Product::count());
});

test('that a product without prices, reviews or order rows can be deleted', function () {
    $category = Category::firstOrFail();
    $product = Product::create([
        'name' => 'Tijdelijk product',
        'description' => 'Dit product wordt verwijderd.',
        'category_id' => $category->id,
    ]);

    expect($product->canDelete())->toBeTrue();

    $this->delete(route('products.delete', $product))
        ->assertRedirect('/products')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('that a product with prices cannot be deleted', function () {
    $product = Product::with('prices')->firstOrFail();

    expect($product->canDelete())->toBeFalse();

    $this->delete(route('products.delete', $product))
        ->assertRedirect('/products')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('products', ['id' => $product->id]);
});
