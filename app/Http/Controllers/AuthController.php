<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    /**
     * Handle login submission
     */
    public function login(Request $request)
    {
        // Validate inputs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    // Redirect based on role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenue administrateur !');
        }

        return redirect()->route('home')->with('success', 'Connexion réussie !');
    }
        }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('login.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login user automatically
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Compte créé avec succès !');
    }
}
