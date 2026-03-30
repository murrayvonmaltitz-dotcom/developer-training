<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'John@example.com')
        ->fill('password', 'password')
        ->click('Create Account')
        ->assertPathIs('/');
    
    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        "name" => "John Doe",
        "name" => "John@example.com",
    ]);
});
