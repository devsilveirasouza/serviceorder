<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Return an view for the home page
     */
    public function __invoke()
    {
        return view('home');
    }

}
