<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Transport; // Importer le modèle Transport
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        // Récupérer toutes les livraisons
        $deliveries = Delivery::all();
    
        // Récupérer les transporteurs disponibles (status == 'Available')
        $availableTransports = Transport::where('status', Transport::STATUS_AVAILABLE)->get();
    
        // Passer les données des livraisons et des transporteurs disponibles à la vue
        return view('deliveries.index', compact('deliveries', 'availableTransports'));
    }
    

    public function create()
    {
        // Récupérer tous les transporteurs disponibles (status == 'Available')
        $availableTransports = Transport::where('status', Transport::STATUS_AVAILABLE)->get();

        return view('deliveries.create', compact('availableTransports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_address' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'transport_id' => 'required|exists:transports,id',  // Valider le transport sélectionné
        ]);

        // Créer la livraison
        $delivery = Delivery::create($request->all());

        // Mettre à jour le statut du transporteur sélectionné à 'Unavailable'
        $transport = Transport::find($request->transport_id);
        $transport->update(['status' => Transport::STATUS_UNAVAILABLE]);

        return redirect()->route('deliveries.index')->with('success', 'Delivery added successfully.');
    }


    public function update(Request $request, Delivery $delivery)
{
    // Récupérer tous les transporteurs disponibles (status == 'Available')
    $availableTransports = Transport::where('status', Transport::STATUS_AVAILABLE)->get();
    
    // Initialiser les règles de validation
    $rules = [
        'start_address' => 'required|string|max:255',
        'delivery_address' => 'required|string|max:255',
        'recipient_name' => 'required|string|max:255',
        'status' => 'required|string|max:50',
        // Rendre transport_id nullable
        'transport_id' => 'nullable|exists:transports,id',
    ];

    // Log the final validation rules
    \Log::info('Validation rules: ', $rules);
    
    // Validate the request
    $request->validate($rules);

    // Récupérer l'ancien transporteur et son statut
    $oldTransportId = $delivery->transport_id;

    // Mettre à jour la livraison avec les nouvelles informations
    $delivery->update($request->all());

    // Gérer l'ancien transporteur
    if ($oldTransportId) {
        $oldTransport = Transport::find($oldTransportId);
        if ($oldTransport) {
            // Si le statut de la livraison passe de Pending à Completed, ou si nous changeons de transporteur
            if ($delivery->status === 'Completed' || $oldTransportId !== $request->transport_id) {
                $oldTransport->status = Transport::STATUS_AVAILABLE; // Réinitialiser l'ancien transporteur à available
                $oldTransport->save();
            }
        }
    }

    // Gérer le nouveau transporteur
    if ($request->transport_id) { // S'il y a un transport_id valide
        $newTransport = Transport::find($request->transport_id);
        $newTransport->status = Transport::STATUS_UNAVAILABLE;
        $newTransport->save();
    }

    return redirect()->route('deliveries.index')->with('success', 'Delivery updated successfully.');
}

    


   // DeliveryController.php
public function destroy(Delivery $delivery)
{
    // Vérifiez si la livraison a un transport associé
    if ($delivery->transport) {
        // Réinitialiser le statut du transporteur à 'Available'
        $delivery->transport->status = Transport::STATUS_AVAILABLE;
        $delivery->transport->save();
    }

    // Supprimer la livraison
    $delivery->delete();
    return redirect()->route('deliveries.index')->with('success', 'Delivery deleted successfully.');
}


    // Optionnel : Méthode pour finaliser une livraison et rendre le transport disponible
    public function finalizeDelivery($id)
    {
        // Trouver la livraison
        $delivery = Delivery::find($id);

        // Mettre à jour le statut de la livraison à 'completed'
        $delivery->status = 'completed';
        $delivery->save();

        // Rendre le transport disponible à nouveau
        $transport = $delivery->transport;
        $transport->status = Transport::STATUS_AVAILABLE;
        $transport->save();

        return redirect()->back()->with('success', 'Delivery completed and transport available.');
    }
}
