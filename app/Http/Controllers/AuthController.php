<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {
                return redirect()->intended('admin');
            } elseif ($user->role == 'superadmin') {
                return redirect()->intended('superadmin');
            }
        }
        return view('auth/login');;
    }

    public function login(Request $request)
    {
            request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credential = $request->only('email','password');
            $loginCheck = Auth::attempt($credential);

            if($loginCheck){
                $user = Auth::user();
                if ($user->role == 'admin') {
                    return redirect()->intended('admin');
                } elseif ($user->role == 'owner') {
                    return redirect()->intended('owner');
                }
                return redirect()->intended('/');
            }

        return redirect('/')->withInput()->withErrors(['login_failed' => 'Login failed']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $logout = Auth::logout();
        return redirect('/');
    }
}