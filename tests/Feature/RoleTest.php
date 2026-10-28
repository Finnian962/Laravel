<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());
});

test('that the roles page has a create modal and a delete button per role', function () {
    $empty = Role::create(['name' => 'Lege rol']);
    $withUsers = Role::has('users')->firstOrFail();

    $response = $this->get('/roles');

    $response->assertOk();
    $response->assertSee('id="create-role-modal"', false);
    $response->assertSee(route('roles.create'), false);
    $response->assertSee(route('roles.delete', $empty), false);
    $response->assertDontSee(route('roles.delete', $withUsers), false);
});

test('that a role can be created', function () {
    $this->from('/roles')
        ->post(route('roles.create'), ['name' => 'Beheerder'])
        ->assertRedirect('/roles')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('roles', ['name' => 'Beheerder']);
});

test('that creating a role without a name fails validation', function () {
    $count = Role::count();

    $this->from('/roles')
        ->post(route('roles.create'), ['name' => ''])
        ->assertRedirect('/roles')
        ->assertSessionHasErrors('name');

    $this->assertSame($count, Role::count());
});

test('that a role without users can be deleted', function () {
    $role = Role::create(['name' => 'Tijdelijke rol']);

    expect($role->canDelete())->toBeTrue();

    $this->delete(route('roles.delete', $role))
        ->assertRedirect('/roles')
        ->assertSessionHas('status');

    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});

test('that a role with users cannot be deleted', function () {
    $role = Role::has('users')->firstOrFail();

    expect($role->canDelete())->toBeFalse();

    $this->delete(route('roles.delete', $role))
        ->assertRedirect('/roles')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('roles', ['id' => $role->id]);
});
