<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        //check if logged in user id matches that to the user id on the current idea
        //return $user->id === $idea->user_id;

        //eloquent equivilent based on my model relationships
        return $user->is($idea->user);
    }

        public function create(User $user): bool
    {
        return $user->isAdmin();
    }
}
