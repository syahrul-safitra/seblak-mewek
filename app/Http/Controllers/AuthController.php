<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|max:20',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/dashboard')->with('success', 'Berhasil login sebagai admin');
        }

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('/')->with('success', 'Berhasil login customer');
        }

        return back()->with('loginError', 'Login Failed');
    }
}
