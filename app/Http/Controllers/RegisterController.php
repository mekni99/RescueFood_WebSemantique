<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Volunteer;

use Illuminate\Support\Facades\Auth;
use App\http\Controllers\VolunteerController;
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

        // Créer l'utilisateur
        $user = User::create($attributes);

        // Authentifier l'utilisateur
        auth()->login($user);

        // Redirection en fonction du rôle
        if ($user->role === 'restaurant') {
            return redirect()->route('dons.index'); // Rediriger vers la page des dons pour les restaurants
        }

       
        if ($user->role === 'association') {
            Volunteer::create([
                'name' => $user->username,         // Set the name or however you want
                'location' => '',                   // Customize as needed
                'availability' => '',               // Customize as needed
                'telephone_number' => '',           // Customize as needed
                'association_id' => $user->id,      // Use the user's ID as association_id
            ]);
            return redirect('/frontassociation');
     // Redirection par défaut (par exemple, pour 'association' ou d'autres rôles)
        return redirect('/dashboard');
    }
}
}