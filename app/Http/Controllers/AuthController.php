<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {   
        if (Auth::check()) {

            if (Auth::user()->role == 'kepala_desa') {
                return redirect()->route('kepala.dashboard');
            }

            return redirect()->route('aparat.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $login = strtolower($request->login);
        $password = $request->password;

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $login, 'password' => $password])) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'kepala_desa') {
                return redirect()->route('kepala.dashboard');
            }

            return redirect()->route('aparat.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
