<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the category overview links to every category with its game count', function () {
    $response = $this->get('/categories');

    $response->assertOk();

    foreach (Category::withCount('products')->get() as $category) {
        $response->assertSee(route('categories.show', $category), false);
        $response->assertSee($category->name);
        $response->assertSee((string) $category->products_count);
    }
});

test('that opening a category shows the games of that category', function () {
    $category = Category::where('name', 'Puzzelspellen')->firstOrFail();

    $response = $this->get(route('categories.show', $category));

    $response->assertOk();
    $response->assertSee($category->name);
    $response->assertSee('Spellen ('.$category->products()->count().')');

    foreach ($category->products as $product) {
        $response->assertSee($product->name);
        $response->assertSee($product->description);
    }
});

test('that every page with a category links to that category', function () {
    $category = Category::where('name', 'Avonturenspellen')->firstOrFail();
    $categoryUrl = route('categories.show', $category);

    $this->get('/')->assertOk()->assertSee($categoryUrl, false);
    $this->get('/products')->assertOk()->assertSee($categoryUrl, false);
    $this->get('/categories')->assertOk()->assertSee($categoryUrl, false);
});

test('that the pages with a product show the category of that product', function () {
    $this->seed();

    $category = Category::firstOrFail();
    $categoryUrl = route('categories.show', $category);

    $this->get('/prices')->assertOk()->assertSee($categoryUrl, false);
    $this->get('/reviews')->assertOk()->assertSee($categoryUrl, false);
    $this->get('/orderrows')->assertOk()->assertSee($categoryUrl, false);
});

test('that the categories page has a create modal and a delete button per category', function () {
    $empty = Category::create(['name' => 'Lege categorie']);
    $withGames = Category::withCount('products')->where('products_count', '>', 0)->firstOrFail();

    $response = $this->get('/categories');

    $response->assertOk();
    $response->assertSee('id="create-category-modal"', false);
    $response->assertSee(route('categories.create'), false);
    $response->assertSee(route('categories.delete', $empty), false);
    $response->assertDontSee(route('categories.delete', $withGames), false);
});

test('that a category can be created', function () {
    $this->from('/categories')
        ->post(route('categories.create'), ['name' => 'Nieuwighedenspellen'])
        ->assertRedirect('/categories')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('categories', ['name' => 'Nieuwighedenspellen']);
});

test('that creating a category without a name fails validation', function () {
    $count = Category::count();

    $this->from('/categories')
        ->post(route('categories.create'), ['name' => ''])
        ->assertRedirect('/categories')
        ->assertSessionHasErrors('name');

    $this->assertSame($count, Category::count());
});

test('that a category without games can be deleted', function () {
    $category = Category::create(['name' => 'Tijdelijke categorie']);

    expect($category->canDelete())->toBeTrue();

    $this->delete(route('categories.delete', $category))
        ->assertRedirect('/categories')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

test('that a category with games cannot be deleted', function () {
    $category = Category::withCount('products')->where('products_count', '>', 0)->firstOrFail();

    expect($category->canDelete())->toBeFalse();

    $this->delete(route('categories.delete', $category))
        ->assertRedirect('/categories')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
});
