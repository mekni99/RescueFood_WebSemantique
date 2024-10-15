<?php

namespace App\Http\Controllers;

use App\Models\Don;
use Illuminate\Http\Request;

class DonController extends Controller
{
    public function create($restaurant_id)
    {
        return view('pages.dons.create', compact('restaurant_id'));
    }

    public function index()
{
    // Récupérer le restaurant de l'utilisateur authentifié
    $restaurant = auth()->user(); // L'utilisateur est le restaurant dans ce cas.

    // Vérifiez que l'utilisateur (restaurant) existe
    if (!$restaurant) {   
        return redirect()->back()->with('error', 'Restaurant non trouvé.');
    }

    // Récupérer les dons du restaurant
    $dons = $restaurant->dons; // Assurez-vous que la relation dons existe dans le modèle Restaurant.

    // Si aucun don n'est trouvé, on initialise à un tableau vide
    if ($dons === null) {
        $dons = collect(); // Utiliser une collection vide si null
    }

    // Retourner la vue avec les dons
    return view('pages.dons.index', compact('dons'));
}


public function store(Request $request)
{
    // Récupérer le restaurant de l'utilisateur authentifié
    $restaurant = auth()->user(); // L'utilisateur est le restaurant dans ce cas.

    // Vérifiez que l'utilisateur (restaurant) existe
    if (!$restaurant) {
        return redirect()->back()->with('error', 'Restaurant non trouvé.');
    }

    // Validation du formulaire
    $validated = $request->validate([
        'category' => 'required|array',
        'category.*' => 'string|max:255', // Validation pour chaque catégorie
        'quantity' => 'required|array',
        'quantity.*' => 'integer|min:1', // Validation pour chaque quantité
    ]);

    // Boucle à travers les catégories et les quantités
    foreach ($validated['category'] as $index => $category) {
        Don::create([
            'restaurant_id' => $restaurant->id,
            'category' => $category,
            'quantity' => $validated['quantity'][$index],
        ]);
    }

    return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès.');
}

}

