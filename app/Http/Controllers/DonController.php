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
            // Fetch donations and paginate them (10 per page)
            $dons = Don::where('user_id', $user->id)->paginate(10);
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour accéder à cette page.');
        }
    
        // Instead of grouping in the controller, we'll iterate through the paginated results in the view.
        return view('pages.dons.index', [
            'dons' => $dons,
            'user_id' => $user->id
        ]);
    }
    public function aboutUs()
    {
        return view('pages.aboutus');
    }
public function filter(Request $request)
    {
        // Filter by date if provided
        $date = $request->input('date');

        if ($date) {
            $donsGroupedByDate = Donation::whereDate('created_at', $date)
                ->get()
                ->groupBy(function($donation) {
                    return $donation->created_at->format('Y-m-d');
                });
        } else {
            // Default view, no date filtering
            $donsGroupedByDate = Donation::all()
                ->groupBy(function($donation) {
                    return $donation->created_at->format('Y-m-d');
                });
        }

        return view('pages.dons.index', compact('donsGroupedByDate'));
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
        // Validate the form input
        $attributes = $request->validate([
            'category' => 'required|array', // Validate as an array
            'category.*' => 'string|max:255', // Validate each category
            'food_subtype' => 'nullable|array', // Validate sub-categories as an array
            'food_subtype.*' => 'string|max:255',
            'quantity' => 'required|array', // Validate as an array
            'quantity.*' => 'numeric|min:1', // Validate each quantity
           'date_preemption' => 'required|array', // Validation for expiration date
            'date_preemption.*' => 'date', // Validation pour chaque date de péremption
        ]);
        $validatedData = $request->validate([
            'food_type.*' => 'required|string',
            'category.*' => 'required|string',
            'food_subtype.*' => 'required|string',
            'quantity.*' => 'required|integer|min:1',
            'date_preemption.*' => 'nullable|date|after:today', // Validate date_preemption (optional)
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Ensure the user has the 'restaurant' role
        if ($user->role !== 'restaurant') {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation pour effectuer cette action.');
        }
    
        // Loop through the categories and quantities to create donations
        // Loop through the categories and quantities to create donations
foreach ($validatedData['quantity'] as $index => $quantity) {
    // Créer un don
    Don::create([
        'user_id' => $user_id,
        'category' => $validatedData['category'][$index], // Utilisation correcte de category
        'sub_category' => $validatedData['food_subtype'][$index],
        'quantity' => $quantity,
        'date_preemption' => $validatedData['date_preemption'][$index] ?? null, // Ajout de date_preemption
    ]);

    // Vérifier si un élément de stock existe déjà pour cette catégorie
    $category = $validatedData['category'][$index]; // Défini $category correctement
    $sub_category = $validatedData['food_subtype'][$index] ?? null; // Ajout de la sous-catégorie

    $stockItem = Stock::where('category', $category)
        ->where('sub_category', $sub_category)
        ->first();

    if ($stockItem) {
        // Si l'élément de stock existe, additionner la quantité
        $stockItem->quantity += $quantity; // Utilisez la quantité du don
        $stockItem->save();
    } else {
        // Sinon, créer un nouvel élément de stock
        Stock::create([
            'category' => $category,
            'sub_category' => $sub_category, // Ajouter la sous-catégorie
            'quantity' => $quantity, // Utilisez la quantité du don
        ]);
    }
}

    
        // Redirect with success message
        return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès');
    }


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
