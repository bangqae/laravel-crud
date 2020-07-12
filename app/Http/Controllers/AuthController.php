<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        // If user already login, prevent them from access login form
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auths.login');
        }
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
