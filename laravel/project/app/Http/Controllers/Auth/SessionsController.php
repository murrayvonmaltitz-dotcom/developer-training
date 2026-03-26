<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Validation\Rules\Password;

class SessionsController extends Controller
{
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "email" => ['required', 'string', 'email', 'max:255'],
            "password" => ['required', Password::default()]
        ]);

        if (FacadesAuth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/ideas');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match out records'
        ]);
    }

    /**
     * Remove the specified resource from storage. ---logout
     */
    public function destroy()
    {
        FacadesAuth::logout();

        return redirect('/ideas');
    }
}
