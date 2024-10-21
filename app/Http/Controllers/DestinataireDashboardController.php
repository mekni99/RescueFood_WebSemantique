<?php

namespace App\Http\Controllers;
use App\Models\Destinataire;

use Illuminate\Http\Request;
use App\Models\AssociationRequest;

use App\Models\Notification; 

class DestinataireDashboardController extends Controller
{
    
    /**
     * Afficher une liste des destinataires.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        $destinataires = Destinataire::all(); // Récupérer tous les destinataires
        $requests = AssociationRequest::all(); // Récupérer toutes les demandes (assurez-vous d'avoir le bon modèle)
        return view('pages.destinataire-dashboard', compact('notifications','destinataires', 'requests'));
    }

    /**
     * Stocker un nouveau destinataire.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'specific_needs' => 'nullable|string|max:255',
            'request_id' => 'required|exists:association_requests,id',

        ]);

        $destinataire = Destinataire::create($request->all());

        return redirect()->route('destinataire.index')->with('success', 'Destinataire ajouté avec succès.');
    }

    /**
     * Mettre à jour un destinataire existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Destinataire  $destinataire
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Destinataire $destinataire)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'specific_needs' => 'nullable|string|max:255',
        ]);

        $destinataire->update($request->all());

        return redirect()->route('destinataire.index')->with('success', 'Destinataire mis à jour avec succès.');
    }

    /**
     * Supprimer un destinataire.
     *
     * @param  Destinataire  $destinataire
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Destinataire $destinataire)
    {
        $destinataire->delete();

        return redirect()->route('destinataire.index')->with('success', 'Destinataire supprimé avec succès.');
    }

   
    
}
