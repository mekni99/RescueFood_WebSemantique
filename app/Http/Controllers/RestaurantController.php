<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
        ]);

        Restaurant::create($request->all());
        return redirect()->route('restaurants.index')->with('success', 'Restaurant created successfully.');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);
    
        // Trouver et mettre à jour le restaurant
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->all());
    
        return response()->json(['message' => 'Restaurant mis à jour avec succès', 'restaurant' => $restaurant], 200);
    }
    
    


    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }
}
