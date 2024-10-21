<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit; // <-- This is the missing import
use App\Models\Stock; // <-- This is the missing import
use App\Models\Association; // <-- Make sure this is imported
use App\Models\Notification; 


class ProduitController extends Controller
{
    //
     // Method to display all products
     public function index()
     {
        $notifications = Notification::all(); // Retrieve notifications from the database

         // Fetch all products from the database
         $produits = Produit::all();
 
         // Return the view with the products
         return view('pages.produit', compact('produits','notifications')); 
     }
    
    // Show the form for creating a new produit (not needed if using modals)
    public function create()
    {
        return view('produits.create'); // Show create form if needed
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'association_name' => 'required|string',
            'product_requested' => 'required|string',
            'quantity' => 'required|integer',
        ]);
    
        // Find the association by name
        $association = Association::where('name', $request->association_name)->first();
    
        // Check if the association exists
        if (!$association) {
            return redirect()->back()->withErrors(['association_name' => 'Association not found']);
        }
    
        // Check if the product already exists for this association
        $produit = Produit::where('association_name', $request->association_name)
            ->where('product_requested', $request->product_requested)
            ->first();
    
        if ($produit) {
            // If the product already exists, just update the quantity
            $produit->quantity += $request->quantity; // Increment the quantity
            $produit->save();
        } else {
            // Create a new product entry
            $produit = new Produit([
                'product_requested' => $request->product_requested,
                'quantity' => $request->quantity,
                'association_name' => $request->association_name,
            ]);
            $produit->save();
        }
    
        return redirect()->route('produits.index')->with('success', 'Produit added successfully.');
    }
    

    // Display the specified produit (not needed if using modals)
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit')); // Show the specified produit
    }

    // Show the form for editing the specified produit (not needed if using modals)
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit')); // Show edit form if needed
    }

    // Update the specified produit in storage
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'association_name' => 'required|string',
            'product_requested' => 'required|string',
            'quantity' => 'required|integer',
        ]
    );
    
        // Récupérez la quantité actuelle en stock pour la catégorie du produit demandé
        $currentStock = Stock::where('category', $produit->product_requested)->first();
    
        // Si un stock existe, ajustez la quantité
        if ($currentStock) {
            $quantityDifference = $request->quantity - $produit->quantity;
    
            // Si la nouvelle quantité est supérieure, diminuer le stock
            if ($quantityDifference > 0) {
                $currentStock->quantity -= $quantityDifference;
            } 
            // Si la nouvelle quantité est inférieure, augmenter le stock
            else {
                $currentStock->quantity += abs($quantityDifference);
            }
    
            // Sauvegarder le stock
            $currentStock->save();
        }

        // Use the Eloquent model's update method
        $produit->update($request->all()); 

        return redirect()->route('produits.index')->with('success', 'Produit updated successfully.');
    }




   



    // Remove the specified produit from storage
    public function destroy(Produit $produit)
    {
        $produit->delete(); // Delete the specified produit

        return redirect()->route('produits.index')->with('success', 'Produit deleted successfully.');
    }
}

