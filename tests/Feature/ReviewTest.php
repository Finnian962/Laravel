<?php

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the reviews page has a create modal and a delete button per review', function () {
    $review = Review::firstOrFail();

    $response = $this->get('/reviews');

    $response->assertOk();
    $response->assertSee('id="create-review-modal"', false);
    $response->assertSee(route('reviews.create'), false);
    $response->assertSee(route('reviews.delete', $review), false);
});

test('that a review can be created', function () {
    $comment = 'Een spannend spel voor jong en oud.';

    $this->from('/reviews')
        ->post(route('reviews.create'), [
            'comment' => $comment,
            'user_id' => User::firstOrFail()->id,
            'product_id' => Product::firstOrFail()->id,
        ])
        ->assertRedirect('/reviews')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('reviews', ['comment' => $comment]);
});

test('that creating a review without a comment fails validation', function () {
    $count = Review::count();

    $this->from('/reviews')
        ->post(route('reviews.create'), [
            'comment' => '',
            'user_id' => User::firstOrFail()->id,
            'product_id' => Product::firstOrFail()->id,
        ])
        ->assertRedirect('/reviews')
        ->assertSessionHasErrors('comment');

    $this->assertSame($count, Review::count());
});

test('that creating a review for an unknown product fails validation', function () {
    $count = Review::count();

    $this->from('/reviews')
        ->post(route('reviews.create'), [
            'comment' => 'Deze review hoort niet opgeslagen te worden.',
            'user_id' => User::firstOrFail()->id,
            'product_id' => Product::max('id') + 1,
        ])
        ->assertRedirect('/reviews')
        ->assertSessionHasErrors('product_id');

    $this->assertSame($count, Review::count());
});

test('that a review can be deleted', function () {
    $review = Review::create([
        'comment' => 'Tijdelijke review.',
        'user_id' => User::firstOrFail()->id,
        'product_id' => Product::firstOrFail()->id,
    ]);

    expect($review->canDelete())->toBeTrue();

    $this->delete(route('reviews.delete', $review))
        ->assertRedirect('/reviews')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
});
