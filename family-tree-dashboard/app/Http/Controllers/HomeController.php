<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Display the welcome page.
     */
    public function index()
    {
        return view('welcome');
    }
}
