<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssociationRequest;

use App\Models\Notification; 

class AssociationRequestController extends Controller
{
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        $requests = AssociationRequest::all();
        return view('pages.associationRequest', compact('notifications','requests'));
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

        AssociationRequest::create($request->all());

        return redirect()->route('requests.index')->with('success', 'Request created successfully.');
    }


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
}

