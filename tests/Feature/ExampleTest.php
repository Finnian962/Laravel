<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $this->seed();
    $this->actingAs(User::firstOrFail());

    $response = $this->get('/');

    $response->assertStatus(200);
});
