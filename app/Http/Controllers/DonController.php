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
    $validatedData = $request->validate([
        'food_type.*' => 'required|string',
        'category.*' => 'required|string',
        'food_subtype.*' => 'required|string',
        'quantity.*' => 'required|integer|min:1',
        'date_preemption.*' => 'nullable|date|after:today', // Validate date_preemption (optional)
    ]);

    foreach ($validatedData['quantity'] as $index => $quantity) {
        Don::create([
            'user_id' => $user_id,
            'category' => $validatedData['category'][$index],
            'sub_category' => $validatedData['food_subtype'][$index],
            'quantity' => $quantity,
            'date_preemption' => $validatedData['date_preemption'][$index] ?? null, // Add date_preemption
        ]);
    }
    return redirect()->route('dons.index')->with('success', 'Dons ajoutés avec succès');
}

    
public function front()
{
    return view('frontoffice'); // Assurez-vous que la vue est frontoffice.blade.php
}

}
