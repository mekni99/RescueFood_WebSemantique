<?php

namespace App\Http\Controllers;
use App\Models\Notification;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->is_read = true; // Assuming you have an 'is_read' column in your notifications table
            $notification->save();

            return redirect()->back()->with('success', 'Notification marked as read.');
        }

        return redirect()->back()->with('error', 'Notification not found.');
    }
    public function index()
    {
        $admin = auth()->user(); // ou la méthode pour récupérer l'admin actuel
        $notifications = Notification::where('user_id', $admin->id)->orderBy('created_at', 'desc')->get();
    
        return view('layouts.navbars.auth.topnav', compact('notifications'));
    }
    

}
