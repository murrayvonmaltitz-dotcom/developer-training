<?php

declare(strict_types=1);

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'John@Doe.com')
        ->fill('password', 'password');
});
