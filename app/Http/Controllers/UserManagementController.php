<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    // List all users
    public function index()
    {
        // Retrieve all users and pass them to the index view
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    // Show form to edit a specific user
    public function edit(User $user)
    {
        // Display the form to edit the user
        return view('pages.users.edit', compact('user'));
    }

    // Update user details
    public function update(Request $request, User $user)
    {
        // Validate the user update information
        $attributes = $request->validate([
            'username' => 'required|max:255|min:2', // Username is required
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Ensure unique email
            'role' => 'required|in:admin,association,restaurant', // Include new roles
            'password' => 'nullable|min:8' // Allow optional password change
        ]);

        // If password is provided, hash it
        

        // Update the user with validated data
        $user->update($attributes);

        // Redirect to the user list with a success message
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
    public function store(Request $request)
    {
        // Validate the information for the new user
        $attributes = $request->validate([
            'username' => 'required|max:255|min:2|unique:users', // Unique username
            'email' => 'required|email|max:255|unique:users', // Unique email
            'role' => 'required|in:admin,association,restaurant', // Include new roles
            'password' => 'required|min:8' // Require a password
        ]);

        // Hash the password before storing it

        // Create a new user with validated data
        User::create($attributes);

        // Redirect to the user list with a success message
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }
}
