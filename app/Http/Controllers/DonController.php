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
        $dons = Don::where('user_id', $user->id)->get();
    } else {
        return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour accéder à cette page.');
    }

    // Group donations by date
    $donsGroupedByDate = $dons->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d'); // Format de date
    });

    // Pass the donations and user_id to the view
    return view('pages.dons.index', [
        'donsGroupedByDate' => $donsGroupedByDate,
        'user_id' => $user->id // Ajout de user_id ici
    ]);
}

    // Show form to create a new donation
// Show form to create a new donation
public function create($user_id)
{
    // Ensure the user has the 'restaurant' role
    if (Auth::user()->role !== 'restaurant') {
        return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour accéder à cette page.');
    }

    // You can also use the restaurant_id to do something if needed
    return view('pages.dons.create', compact('user_id'));
}


    // Store a newly created donation
  public function store(Request $request, $user_id)
{
    $validatedData = $request->validate([
        'food_type.*' => 'required|string',
        'category.*' => 'required|string',
        'food_subtype.*' => 'required|string', // Correction ici
        'quantity.*' => 'required|integer|min:1',
    ]);

    foreach ($validatedData['quantity'] as $index => $quantity) {
        Don::create([
            'user_id' => $user_id,
            'category' => $validatedData['category'][$index],
            'sub_category' => $validatedData['food_subtype'][$index], // Utilisez food_subtype ici
            'quantity' => $quantity,
        ]);
    }
    return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès');

}
public function front()
{
    return view('frontoffice'); // Assurez-vous que la vue est frontoffice.blade.php
}

}
