<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssociationRequest;
use App\Models\Stock; // <-- This is the missing import
use App\Http\Controllers\StockController;
use App\Models\Don;
use App\Models\Produit;
use App\Models\Association; 

use App\Models\Notification; 

class AssociationRequestController extends Controller
{
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        $requests = AssociationRequest::all();
        return view('pages.associationRequest', compact('notifications','requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

      
public function store(Request $request)
{
    $request->validate([
        'association_name' => 'required|string',
        'association_email' => 'required|email',
        'product_requested' => 'required|string',
        'quantity' => 'required|integer',
        'status' => 'required|in:Pending,Completed,Rejected',
    ]);
   // Trouver l'association par son nom
   $association = Association::where('name', $request->association_name)->first();

   // Vérifier si l'association existe
   if (!$association) {
       // Stocker le message d'erreur dans la session
       session()->flash('error', 'Association non trouvée.');
       // Retourner à la même page
       return back();
   }

   // Créer la demande d'association sans association_id
   AssociationRequest::create($request->except('association_id'));

   // Stocker le message de succès dans la session
   session()->flash('success', 'Demande d\'association créée avec succès.');

   // Retourner à la même page
   return back();
} 
//         AssociationRequest::create($request->all());

//         return redirect()->route('requests.index')->with('success', 'Request created successfully.');
//     }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'association_name' => 'required|string|max:255',
            'association_email' => 'required|email',
            'product_requested' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'required|string'
        ]);
    
        $requestModel = AssociationRequest::findOrFail($id);
        $requestModel->update($request->all());
        // Retourner une réponse JSON si la requête est faite via AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'request updated successfully.',
                'data' => $requestModel
            ]);
        }
    
        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }
    
    public function destroy($id)
    {
        AssociationRequest::find($id)->delete();

        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }





    public function checkStock($id)
{
    // Récupérer la demande d'association par ID
    $request = AssociationRequest::find($id);
    
    // Vérifier si la demande existe
    if (!$request) {
        return response()->json(['message' => 'Request not found'], 404);
    }

    // Vérifier le stock en utilisant sub_category
    $stock = Stock::where('sub_category', $request->product_requested)->first();

    if ($stock) {
        // Comparer les quantités
        if ($stock->quantity >= $request->quantity) {
            return response()->json(['available' => true]);
        }
        return response()->json(['available' => false]);
    }

    // Si le stock n'existe pas
    return response()->json(['available' => false]);
}

public function acceptRequest(Request $request, $id)
{
    try {
        // Trouver la demande par ID
        $requestToAccept = AssociationRequest::find($id);

        if (!$requestToAccept) {
            return response()->json(['success' => false, 'message' => 'Demande non trouvée.'], 404);
        }

        // Mettre à jour le statut de la demande
        $requestToAccept->status = 'completed'; // Changez le statut à "completed"
        $requestToAccept->save();

        // Trouver l'association par son nom
        $association = Association::where('name', $requestToAccept->association_name)->first(); // Assurez-vous que vous avez un champ 'association_name'

        if (!$association) {
            return response()->json(['success' => false, 'message' => 'Association non trouvée.'], 404);
        }

        // Trouver le stock correspondant en utilisant sub_category
        $stock = Stock::where('sub_category', $requestToAccept->product_requested)
                       ->where('quantity', '>=', $requestToAccept->quantity)
                       ->first();

        if (!$stock) {
            return response()->json(['success' => false, 'message' => 'Stock insuffisant.'], 400);
        }

        // Mettre à jour la quantité dans le stock
        $stock->quantity -= $requestToAccept->quantity;

        // Si la quantité devient 0, supprimez l'enregistrement du stock
        if ($stock->quantity <= 0) {
            $stock->delete(); // Supprimer le stock si la quantité est 0 ou moins
        } else {
            $stock->save(); // Sinon, sauvegarder le changement de quantité
        }

        // Enregistrer les informations dans la table Produit
        Produit::create([
            'association_name' => $association->name, // Utilisez le nom de l'association trouvé
            'product_requested' => $requestToAccept->product_requested,
            'quantity' => $requestToAccept->quantity,
        ]);

        return response()->json(['success' => true, 'message' => 'Demande acceptée avec succès et stock mis à jour.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    }
}




}

