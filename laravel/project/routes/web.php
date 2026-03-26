<?php

use Illuminate\Support\Facades\Route;
use App\Models\Idea;

Route::get('/', function () {
    //$ideas = Idea::all(); //all fields

    $ideas = Idea::when(request('state'), function ($query, $state) {
        $query->where('state', $state); 
    })
    ->get(); //pulls state into $state from query string eg ?state=pending

    //$ideas = Idea::where('state', 'pending')->get(); //ideas where state = pending

    return view('ideas', [
        'ideas' => $ideas
    ]);
});

Route::post('/ideas', function () {
    //created_at and updated_at auto fills with eloquent 
    Idea::create([
        'description' => request('idea'),
        'state' => 'pending'
    ]);

    return redirect('/');
});

Route::get('/delete-ideas', function() {
    session()->forget('ideas');

    return redirect('/');
});
