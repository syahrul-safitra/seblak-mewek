<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {

        if (Auth::guard('admin')->check() || Auth::guard('customer')->check()) {
            return redirect('/');
        }

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

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        Auth::guard('customer')->logout();

        return redirect('/');
    }
}
