<?php

use App\Models\Idea;
use App\Models\User;
use Ramsey\Collection\Collection;

test('it belong to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('it can have steps', function () {
    $idea = Idea::factory()->create();

    $idea->steps()->create([
        'description' => "Do the thing"
        ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});
