<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

test('that the login page can be opened', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Inloggen');
});

test('that a guest is sent to the login page', function () {
    $this->get(route('home'))->assertRedirect(route('login'));

    $this->get(route('categories.index'))->assertRedirect(route('login'));
});

test('that the login form requires an e-mail address', function () {
    $this->post(route('login.attempt'), ['email' => ''])
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('that a wrong password is rejected', function () {
    $user = User::firstOrFail();

    $this->from(route('categories.index'))
        ->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'onjuist-wachtwoord',
        ])
        ->assertRedirect(route('categories.index'))
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('that the right credentials log you in and send you back', function () {
    $user = User::firstOrFail();

    $this->get(route('categories.index'))->assertRedirect(route('login'));

    $this->post(route('login.attempt'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('categories.index'));

    $this->assertAuthenticatedAs($user);
});

test('that logging out ends the session', function () {
    $user = User::firstOrFail();

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    $this->assertGuest();

    $this->get(route('categories.index'))->assertRedirect(route('login'));
});
