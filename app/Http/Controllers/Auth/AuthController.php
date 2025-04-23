<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            // Redirection selon le rôle
            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'responsable' => redirect()->route('club.dashboard', ['id' => Auth::id()]),
                default => redirect('/') // Fallback (normalement inaccessible)
            };
        }
            
        

        return back()->withErrors([
            'email' => 'Les identifiants fournis sont incorrects ',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
