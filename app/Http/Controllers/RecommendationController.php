<?php

namespace App\Http\Controllers;

use App\Models\Recommendation; // Importer le modèle Recommendation
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recommendations = Recommendation::all(); // Récupérer toutes les recommandations
        return view('recommendations.index', compact('recommendations')); // Passer la variable à la vue
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Fruits,Légumes,Produits laitiers,Autre',
            'practical_tips' => 'required|string',
            'shelf_life' => 'required|string',
            'state' => 'required|in:Frais,Congelé,Préparé',
            'creation_date' => 'required|date',
            'status' => 'required|in:Actif,Obsolète,En révision',
        ]);

        $recommendation = Recommendation::create($request->all());

        // Retourner une réponse JSON si la requête est faite via AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Recommendation created successfully.',
                'data' => $recommendation
            ]);
        }

        return redirect()->route('recommendations.index')->with('success', 'Recommendation created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Fruits,Légumes,Produits laitiers,Autre',
            'practical_tips' => 'required|string',
            'shelf_life' => 'required|string',
            'state' => 'required|in:Frais,Congelé,Préparé',
            'creation_date' => 'required|date',
            'status' => 'required|in:Actif,Obsolète,En révision',
        ]);

        $recommendation = Recommendation::findOrFail($id);
        $recommendation->update($request->all());

        // Retourner une réponse JSON si la requête est faite via AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Recommendation updated successfully.',
                'data' => $recommendation
            ]);
        }

        return redirect()->route('recommendations.index')->with('success', 'Recommendation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        $recommendation->delete();

        // Retourner une réponse JSON si la requête est faite via AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Recommendation deleted successfully.'
            ]);
        }

        return redirect()->route('recommendations.index')->with('success', 'Recommendation deleted successfully.');
    }
}
