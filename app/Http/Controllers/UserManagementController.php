<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notification; 

class UserManagementController extends Controller
{


    // List all users
    public function index()
    {

        $notifications = Notification::all(); // Retrieve notifications from the database

        // Retrieve all users and pass them to the index view
        $users = User::all();
        return view('pages.users.index', compact('users' ,'notifications'));
    }public function indexRestaurantUsers()
    {

        $notifications = Notification::all(); // Retrieve notifications from the database

        // Filtrer les utilisateurs ayant le rôle 'restaurant'
        $users = User::where('role', 'restaurant')->get();

        return view('pages.users.indexrestaurant', compact('users' ,'notifications'));
    }

    // Show form to edit a specific user
    public function edit(User $user)
    {
        // Display the form to edit the user
        return view('pages.users.edit', compact('user'));
    }

    // Update user details
    public function store(Request $request)
    {
        // Validation incluant les nouveaux champs address et city
        $attributes = $request->validate([
            'username' => 'required|max:255|min:2|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'address' => 'required|max:255', // Nouveau champ
            'city' => 'required|max:100' ,// Nouveau champ
            'role' => 'required|in:admin,association,restaurant',
            'password' => 'required|min:8',
            
        ]);
    
        // Créez le nouvel utilisateur
        User::create($attributes);
    
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }
    
    public function update(Request $request, User $user)
    {
        // Validation incluant address et city
        $attributes = $request->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,association,restaurant',
            'password' => 'nullable|min:8',
            'address' => 'required|max:255', // Nouveau champ
            'city' => 'required|max:100' // Nouveau champ
        ]);
    
        // Mise à jour de l'utilisateur
        $user->update($attributes);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
    

    // Delete a user
    public function destroy(User $user)
    {
        // Delete the selected user
        $user->delete();

        // Redirect to the user list with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    // Store a newly created user
    
}
