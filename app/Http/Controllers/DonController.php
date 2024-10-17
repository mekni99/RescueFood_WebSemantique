<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonController extends Controller
{
    // Show the donation history for the logged-in user with the role 'restaurant'
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user has the 'restaurant' role
        if ($user->role === 'restaurant') {
            // Fetch the donations associated with the user
            $dons = Don::where('restaurant_id', $user->id)->get();
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour accéder à cette page.');
        }
        $donsGroupedByDate = $dons->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d'); // Format de date
        });
        // Pass the donations to the view
        return view('pages.dons.index', compact('donsGroupedByDate'));
    }
   

    // Show form to create a new donation
// Show form to create a new donation
public function create($restaurant_id)
{
    // Ensure the user has the 'restaurant' role
    if (Auth::user()->role !== 'restaurant') {
        return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour accéder à cette page.');
    }

    // You can also use the restaurant_id to do something if needed
    return view('pages.dons.create', compact('restaurant_id'));
}


    // Store a newly created donation
    public function store(Request $request)
    {
        // Validate the form input
        $attributes = $request->validate([
            'category' => 'required|array', // Validate as an array
            'category.*' => 'string|max:255', // Validate each category
            'quantity' => 'required|array', // Validate as an array
            'quantity.*' => 'numeric|min:1', // Validate each quantity
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Ensure the user has the 'restaurant' role
        if ($user->role !== 'restaurant') {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour effectuer cette action.');
        }
    
        // Loop through the categories and quantities to create donations
        foreach ($attributes['category'] as $index => $category) {
            Don::create([
                'restaurant_id' => $user->id, // Assuming restaurant_id corresponds to user ID
                'category' => $category,
                'quantity' => $attributes['quantity'][$index], // Match quantities with categories
            ]);
        }
    
        // Redirect with success message
        return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès');
    }
    
}
