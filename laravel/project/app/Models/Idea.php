<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    //removes guarded protection
    protected $guarded = [];
    //create a one to many relationship between user and ideas 

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}
