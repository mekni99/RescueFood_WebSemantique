<?php

namespace App\Http\Controllers;

use App\Models\Transport; // Importer le modèle Transport
use Illuminate\Http\Request;
use App\Models\Notification; 

class TransportController extends Controller
{
    // Afficher la liste des transports
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        $transports = Transport::all();
        return view('transports.index', compact('transports','notifications')); // Passer les transports à la vue
    }

    // Créer un transport
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'driver_name' => 'required|string|max:255',
            'status' => 'required|in:Available,Unavailable',
        ]);

        $transport = Transport::create($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Transport created successfully.',
                'data' => $transport
            ]);
        }
        

        return redirect()->route('transports.index')->with('success', 'Transport created successfully.');
    }

// Modifier un transport
public function update(Request $request, $id)
{
    $request->validate([
        'vehicle_type' => 'required|string|max:255',
        'license_plate' => 'required|string|max:255',
        'driver_name' => 'required|string|max:255',
        'status' => 'required|in:Available,Unavailable', // Assurez-vous que les valeurs correspondent à vos constantes
    ]);

    $transport = Transport::findOrFail($id);
    
    // Mettre à jour les attributs
    $transport->update([
        'vehicle_type' => $request->vehicle_type,
        'license_plate' => $request->license_plate,
        'driver_name' => $request->driver_name,
        'status' => $request->status,
    ]);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => 'Transport updated successfully.',
            'data' => $transport
        ]);
    }

    return redirect()->route('transports.index')->with('success', 'Transport updated successfully.');
}


    // Supprimer un transport
    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Transport deleted successfully.'
            ]);
        }

        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully.');
    }
}
