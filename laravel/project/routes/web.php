<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;

Route::get('/', function () {
    return 'placeholder for homepage';
});

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');
    Route::get('/ideas/create', [IdeaController::class, 'create']);
    Route::post('/ideas', [IdeaController::class, 'store']);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);

    Route::delete('/logout', [SessionsController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);
   
    Route::get('/login', [SessionsController::class, 'create'])->name("login");
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::get('/admin', function () {
    return 'private admin area only';
})->can('view-admin');

