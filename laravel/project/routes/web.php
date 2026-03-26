<?php

use Illuminate\Support\Facades\Route;
use App\Models\Idea;

Route::get('/ideas', function () {
    //$ideas = Idea::where('state', 'pending')->get(); //ideas where state = pending
    // $ideas = Idea::when(request('state'), function ($query, $state) {
        //     $query->where('state', $state); 
        // })
        // ->get(); //pulls state into $state from query string eg ?state=pending
        
    $ideas = Idea::all(); //all fields 
    
    return view('ideas.index', [
        'ideas' => $ideas
    ]);
});

//single idea from id passing $id into the function
Route::get('/ideas/{id}', function ($id) {
    $idea = Idea::find($id);
    
    return view('ideas.show', [
        'idea' => $idea
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
    //!!deletes everything in table
    Idea::truncate();

    return redirect('/ideas');
});
