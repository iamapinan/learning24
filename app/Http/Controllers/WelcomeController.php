<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcat;


class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    
    public function index()
    {
        // get subcat table
        $subcats = \App\Subcat::all();
        return view('welcome', compact('subcats'));
    }
}
