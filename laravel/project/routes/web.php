<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'greeting' => "Hello!",
        'person' => request('person', "World")
    ]);
});

Route::view('/about', 'about');
Route::view('/contact', 'contact');
