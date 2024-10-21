<?php

namespace App\Http\Controllers;
use App\Models\Stock; // <-- This is the missing import
use App\Models\AssociationRequest;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class StockController extends Controller
{

    public function index()
    {
        $items = Stock::all();
       
        $totalQuantitiesByCategory = Stock::select('category', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('category')
        ->get();

    // Préparer les données pour le graphique
    $categories = $totalQuantitiesByCategory->pluck('category');
    $quantities = $totalQuantitiesByCategory->pluck('total_quantity');

        return view('pages.stock', compact('items', 'categories', 'quantities')); // Use 'items' instead of 'stocks'
    }

    public function create()
    {
        return view('stock.create');
    }

    public function store(Request $request)
{
    // Valider les données
    $request->validate([
        'category' => 'required',
        'quantity' => 'required|integer',
        'sub_category' => 'required',
    ]);

    // Rechercher un article existant avec la même catégorie et sous-catégorie
    $existingStock = Stock::where('category', $request->category)
                          ->where('sub_category', $request->sub_category)
                          ->first();

    if ($existingStock) {
        // Si un article avec la même sous-catégorie existe, ajouter la quantité
        $existingStock->quantity += $request->quantity;
        $existingStock->save();

        // Retourner un message de succès sans créer un nouvel article
        return redirect()->route('stock.index')->with('success', 'Quantité ajoutée à l\'article existant.');
    } else {
        // Si aucun article avec la même sous-catégorie n'existe, créer un nouvel article
        Stock::create($request->all());

        // Retourner un message de succès pour la création de l'article
        return redirect()->route('stock.index')->with('success', 'Stock créé avec succès.');
    }
}


    public function show(Stock $stock)
    {
        return view('stock.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'category' => 'required',
            'quantity' => 'required|integer',
            'sub_category' => 'required'
            
        ]);

        $stock->update($request->all());

        return redirect()->route('stock.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully.');
    }

   

    
    
}
