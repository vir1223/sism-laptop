<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Handle login logic here
        // Validate the request, authenticate the user, etc.
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'murid') {
                return redirect()->route('murid.dashboard');
            } elseif ($user->role === 'guru') {
                return redirect()->route('guru.dashboard');
            } else {
                // Fallback for unrecognized role
                Auth::logout();
                return back()->withErrors(['role' => 'Role pengguna tidak dikenali']);
            }
        }
        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        // Handle logout logic here
        // Invalidate the session, etc.
        Auth::logout();
        return redirect('/');
    }

   
    public function showLoginForm()
    {
        return view('auth.login'); // Return the login view
    }
}
