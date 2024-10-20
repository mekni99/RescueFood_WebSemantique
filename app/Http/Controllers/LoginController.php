<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        // Check user role and redirect accordingly
        $user = Auth::user();

        // Ensure the user has the 'restaurant' role
        if ($user->role === 'restaurant')  {
            return redirect()->route('frontoffice'); // Redirect to dashboard for restaurant role
        }
        if ($user->role === 'association') {
            return redirect()->route('frontassosiation');
        }

        // Add other roles as needed
        return redirect()->route('/dashboard'); // Default redirect for other roles
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
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
