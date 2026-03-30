<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        if (! Auth::attempt($attributes)) {
            return back()
                ->withErrors(['password' => 'we were unable to authenticate using the current credentails'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended()->with('success', 'You are now logge in!');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
