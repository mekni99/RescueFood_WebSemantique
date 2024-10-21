<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index()
    {
        // Fetch volunteers associated with the authenticated association
        $association = Auth::user(); // Assuming the authenticated user is the Association
        $volunteers = $association->volunteers; // Fetching the associated volunteers
        
        // Pass the volunteers to the main view (e.g., 'volunteers.index')
        return view('volunteers.index', compact('volunteers'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:15',
        ]);

        // Get the authenticated association
        $association = Auth::user();

        // Create new volunteer and associate with the logged-in association
        $volunteer = new Volunteer($request->all());
        $volunteer->association()->associate($association);
        $volunteer->save();

        return redirect()->route('volunteers.index')->with('success', 'Volunteer ajouté avec succès.');
    }

    public function edit($id)
    {
        // Fetch volunteer for editing, ensuring it's associated with the authenticated association
        $association = Auth::user();
        $volunteer = Volunteer::where('id', $id)->where('association_id', $association->id)->firstOrFail();
        
        return view('volunteers.edit', compact('volunteer'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:15',
        ]);

        // Find and update the volunteer for the authenticated association
        $association = Auth::user();
        $volunteer = Volunteer::where('id', $id)->where('association_id', $association->id)->firstOrFail();
        $volunteer->update($request->all());

        return redirect()->route('volunteers.index')->with('success', 'Volunteer mis à jour.');
    }

    public function destroy($id)
    {
        // Find and delete the volunteer, ensuring it belongs to the authenticated association
        $association = Auth::user();
        $volunteer = Volunteer::where('id', $id)->where('association_id', $association->id)->firstOrFail();
        $volunteer->delete();

        return redirect()->route('volunteers.index')->with('success', 'Volunteer supprimé.');
    }
}
