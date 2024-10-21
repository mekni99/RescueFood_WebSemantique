<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; 

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = Notification::all(); // Retrieve notifications from the database

        return view('pages.dashboard',compact('notifications'));
    }
}
