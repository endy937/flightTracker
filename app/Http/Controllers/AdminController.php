<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin'); // Blade yang tadi dibuat
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember)) {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // Buat view untuk dashboard admin
    }
}
