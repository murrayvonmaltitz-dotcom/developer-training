<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $ideas = DB::table('ideas')->get();

    return view('ideas', [
        'ideas' => $ideas
    ]);
});

Route::post('/ideas', function () {
    $idea = request('idea');

    session()->push('ideas', $idea);

    return redirect('/');
});

Route::get('/delete-ideas', function() {
    session()->forget('ideas');

    return redirect('/');
});
