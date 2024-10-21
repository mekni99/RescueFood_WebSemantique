<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssociationRequest;
use Illuminate\Support\Facades\Auth; // Import de Auth


class UserRequestController extends Controller
{
    public function create()
    {
        return view('pages.create-request');
    }

    public function store(Request $request)
    {
        // Obtenir l'utilisateur connecté
        $user = Auth::user();

        $request->validate([
            'product_requested' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'required|in:Pending,Completed,Rejected',
        ]);

        // Créer la requête avec les champs automatiques
        AssociationRequest::create([
            'association_name' => $user->username, // Nom de l'association automatiquement depuis l'utilisateur
            'association_email' => $user->email, // Email de l'association
            'product_requested' => $request->product_requested,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        return redirect()->route('user.requests.create')->with('success', 'Request created successfully.');
    }
}
