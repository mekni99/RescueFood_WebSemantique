<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; 

class MapController extends Controller
{
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        return view('maps', compact('notifications')); // Utilisez le nom de la vue sans extension
    }
}
