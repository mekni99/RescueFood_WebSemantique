<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Volunteer;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'role' => 'required|in:restaurant,association', 
            'terms' => 'required'
        ]);

        $user = User::create($attributes);
        auth()->login($user);

        // If the user is an association, create the volunteer record
        if ($user->role === 'association') {
            Volunteer::create([
                'name' => $user->username,         // Set the name or however you want
                'location' => '',                   // Customize as needed
                'availability' => '',               // Customize as needed
                'telephone_number' => '',           // Customize as needed
                'association_id' => $user->id,      // Use the user's ID as association_id
            ]);
        }

        return redirect('/dashboard');
    }
}