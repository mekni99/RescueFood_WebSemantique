<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Afficher la liste des restaurants
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    // Afficher le formulaire de création de restaurant
    public function create()
    {
        return view('restaurants.create');
    }

    // Enregistrer un nouveau restaurant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'food_type' => 'required|string|max:255',
            'collection_zone' => 'required|string|max:255',
            'banque_alimentaire_id' => 'required|string|max:255',
        ]);

        Restaurant::create($request->all());

        return redirect()->route('restaurants.index')->with('success', 'Restaurant ajouté avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    // Mettre à jour un restaurant
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15',
            'contact_email' => 'required|email|max:255',
            'food_type' => 'required|string|max:255',
            'collection_zone' => 'required|string|max:255',
            'banque_alimentaire_id' => 'required|string|max:255',
        ]);

        $restaurant->update($request->all());

        return redirect()->route('restaurants.index')->with('success', 'Restaurant mis à jour avec succès.');
    }

    // Supprimer un restaurant
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Restaurant supprimé avec succès.');
    }
}
