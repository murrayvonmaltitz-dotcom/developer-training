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
//can pass a model type into function to access more directly
Route::get('/ideas/{idea}', function (Idea $idea) {
    //find single idea by idea
    //$idea = Idea::find($id);

    // $idea = Idea::findOrFail($id); //if id not found then display 404 page when id is passed through route function
    return view('ideas.show', [
        'idea' => $idea
    ]);
});

Route::post('/ideas', function () {
    //created_at and updated_at auto fills with eloquent 
    Idea::create([
        'description' => request('description'),
        'state' => 'pending'
    ]);

    return redirect('/');
});

//edit show fields to edit 
Route::get('/ideas/{idea}/edit', function (Idea $idea) {
    return view('ideas.edit', [
        'idea' => $idea
    ]);
});

Route::patch('/ideas/{idea}', function (Idea $idea) {
    //update description from request from form in edit view, name of field must be description
    $idea->update([
        'description' => request("description")
    ]);

    return redirect("ideas/{$idea->id}");
});



Route::get('/delete-ideas', function() {
    //!!deletes everything in table
    Idea::truncate();

    return redirect('/ideas');
});
