<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home', [
    'name' => "Murray",
    'frameworks' => ['Laravel', 'Vue', 'Inertia']
])->name('home');
