<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    public function index()
    {
        dd('Controller reached!');
    return view('frontoffice');
        return view('frontoffice'); // Make sure the view file is named frontoffice.blade.php
    }
}
