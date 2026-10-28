<?php

use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the users page has a create modal and a delete button per user', function () {
    $empty = User::create([
        'name' => 'Lege gebruiker',
        'email' => 'lege.gebruiker@example.com',
        'password' => Hash::make('wachtwoord'),
        'role_id' => 1,
    ]);
    $withReviews = User::has('reviews')->firstOrFail();

    $response = $this->get('/users');

    $response->assertOk();
    $response->assertSee('id="create-user-modal"', false);
    $response->assertSee(route('users.create'), false);
    $response->assertSee(route('users.delete', $empty), false);
    $response->assertDontSee(route('users.delete', $withReviews), false);
});

test('that a user can be created', function () {
    $this->from('/users')
        ->post(route('users.create'), [
            'name' => 'Nieuwe gebruiker',
            'email' => 'nieuwe.gebruiker@example.com',
            'password' => 'wachtwoord',
            'role_id' => Role::firstOrFail()->id,
        ])
        ->assertRedirect('/users')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('users', ['email' => 'nieuwe.gebruiker@example.com']);

    $user = User::where('email', 'nieuwe.gebruiker@example.com')->firstOrFail();

    expect(Hash::check('wachtwoord', $user->password))->toBeTrue();
});

test('that creating a user with an invalid email fails validation', function () {
    $count = User::count();

    $this->from('/users')
        ->post(route('users.create'), [
            'name' => 'Nieuwe gebruiker',
            'email' => 'geen-email',
            'password' => 'wachtwoord',
            'role_id' => 1,
        ])
        ->assertRedirect('/users')
        ->assertSessionHasErrors('email');

    $this->assertSame($count, User::count());
});

test('that creating a user with an unknown role fails validation', function () {
    $count = User::count();
    $unknownRoleId = Role::max('id') + 1;

    $this->from('/users')
        ->post(route('users.create'), [
            'name' => 'Nieuwe gebruiker',
            'email' => 'onbekende.rol@example.com',
            'password' => 'wachtwoord',
            'role_id' => $unknownRoleId,
        ])
        ->assertRedirect('/users')
        ->assertSessionHasErrors('role_id');

    $this->assertSame($count, User::count());
});

test('that a user without reviews and orders can be deleted', function () {
    $user = User::create([
        'name' => 'Tijdelijke gebruiker',
        'email' => 'tijdelijke.gebruiker@example.com',
        'password' => Hash::make('wachtwoord'),
        'role_id' => 1,
    ]);

    expect($user->canDelete())->toBeTrue();

    $this->delete(route('users.delete', $user))
        ->assertRedirect('/users')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

test('that a user with reviews cannot be deleted', function () {
    $user = User::has('reviews')->firstOrFail();

    expect($user->canDelete())->toBeFalse();

    $this->delete(route('users.delete', $user))
        ->assertRedirect('/users')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('that a user with orders cannot be deleted', function () {
    $user = User::create([
        'name' => 'Bestellende gebruiker',
        'email' => 'bestellende.gebruiker@example.com',
        'password' => Hash::make('wachtwoord'),
        'role_id' => 1,
    ]);

    Order::create([
        'orderdate' => '2026-01-01',
        'user_id' => $user->id,
        'status' => 'Nieuw',
    ]);

    expect($user->canDelete())->toBeFalse();

    $this->delete(route('users.delete', $user))
        ->assertRedirect('/users')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
