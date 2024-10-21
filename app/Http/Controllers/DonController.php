<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock; // Ajoutez cette ligne

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
     public function store(Request $request)
     {
         // Validate the form input
         $attributes = $request->validate([
             'category' => 'required|array', // Validate as an array
             'category.*' => 'string|max:255', // Validate each category
             'sub_category' => 'nullable|array', // Validate sub-categories as an array
             'sub_category.*' => 'string|max:255',
             'quantity' => 'required|array', // Validate as an array
             'quantity.*' => 'numeric|min:1', // Validate each quantity
            'date_preemption' => 'required|array', // Validation for expiration date
             'date_preemption.*' => 'date', // Validation pour chaque date de péremption
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
                 'user_id' => $user->id, // Assuming restaurant_id corresponds to user ID
                 'category' => $category,
                 'sub_category' => $attributes['sub_category'][$index] ?? null, // Sub-category is optional
                 'quantity' => $attributes['quantity'][$index], // Match quantities with categories
                 'date_preemption' => $attributes['date_preemption'][$index], // New 'date_preemption'
 
             ]);
         }
 
 
 
           // Vérifier si un élément de stock existe déjà pour cette catégorie
           $stockItem = Stock::where('category', $category)
           ->where('sub_category', $attributes['sub_category'][$index] ?? null)
           ->first();
 
           if ($stockItem) {
               // Si l'élément de stock existe, additionner la quantité
               $stockItem->quantity += $attributes['quantity'][$index]; // Utilisez la quantité du don
               $stockItem->save();
           } else {
               // Sinon, créer un nouvel élément de stock
               Stock::create([
                   'category' => $category,
                   'sub_category' => $attributes['sub_category'][$index] ?? null, // Ajouter la sous-catégorie
                   'quantity' => $attributes['quantity'][$index], // Utilisez la quantité du don
               ]);
           }
     
         // Redirect with success message
         return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès');
     }
 
      // Afficher tous les dons de tous les restaurants
      public function indexAllDons()
      {
          // Récupérer tous les dons avec les restaurants associés
          $dons = Don::with('restaurant')->get();
  
          // Passer les dons à la vue
          return view('pages.dons.all', compact('dons'));
      }
 
  
 

public function front()
{
    return view('frontoffice'); // Assurez-vous que la vue est frontoffice.blade.php
}

}
