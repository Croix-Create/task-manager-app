<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
