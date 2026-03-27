<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    //removes guarded protection
    protected $guarded = [];
    //create a one to many relationship between user and ideas 
    public function user() {
        return $this->belongsTo(User::class);
    }
}
