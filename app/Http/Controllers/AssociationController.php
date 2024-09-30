<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        // Fetch all associations
        $associations = Association::all();
        return view('associations.index', compact('associations'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_details' => 'required|string',
            'specific_needs' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Create new association record
        Association::create($request->all());

        return redirect()->route('associations.index')->with('success', 'Association créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_details' => 'required|string',
            'specific_needs' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Find the association and update it
        $association = Association::findOrFail($id);
        $association->update($request->all());

        return redirect()->route('associations.index')->with('success', 'Informations mises à jour.');
    }

    public function destroy($id)
    {
        // Find the association and delete it
        $association = Association::findOrFail($id);
        $association->delete();

        return redirect()->route('associations.index')->with('success', 'Association supprimée.');
    }
}
