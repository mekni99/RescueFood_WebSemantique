<?php

namespace App\Http\Controllers;

use App\Models\Destinataire;
use App\Models\AssociationRequest;
use App\Models\User; 
use App\Models\Notification; // Ajoutez cette ligne
 use Illuminate\Http\Request;

class DestinataireController extends Controller
{
    public function create()
    {
        // Récupérez toutes les demandes
        $requests = AssociationRequest::all(); 
        return view('pages.destinataire', compact('requests')); // Assurez-vous que la vue existe
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|array',
            'first_name.*' => 'required|string|max:255',
            'last_name' => 'required|array',
            'last_name.*' => 'required|string|max:255',
            'contact' => 'required|array',
            'contact.*' => 'required|numeric',  
            'address' => 'required|array',
            'address.*' => 'required|string|max:255',
            'specific_needs' => 'nullable|array',
            'specific_needs.*' => 'nullable|string|max:255',
            'request_id' => 'required|exists:association_requests,id',
        ]);
        $admin = User::where('role', 'admin')->first(); // Exemple avec un rôle 'admin'

    
        foreach ($validatedData['first_name'] as $index => $firstName) {
            $destinataire = Destinataire::create([
                'first_name' => $firstName,
                'last_name' => $validatedData['last_name'][$index],
                'contact' => $validatedData['contact'][$index],  // Assurez-vous que les contacts sont numériques
                'address' => $validatedData['address'][$index],
                'specific_needs' => $validatedData['specific_needs'][$index] ?? null,
                'request_id' => $validatedData['request_id'],
            ]);
        
  // Créer une notification pour l'administrateur
  if ($admin) {
    Notification::create([
        'user_id' => $admin->id,
        'message' => 'Un nouveau destinataire a été ajouté : ' . $destinataire->first_name . ' ' . $destinataire->last_name,
        'is_read' => false, // Par défaut, on peut définir comme non lu

    ]);
}
}
  
    
        return redirect()->route('user.destinataires.create')->with('success', 'Destinataires ajoutés avec succès.');
    }
    
}
