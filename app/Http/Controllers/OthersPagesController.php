<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OthersPagesController extends Controller
{
    // Page fonctionnalités
    public function features()
    {
        return view('features');
    }

    // Page à propos
    public function about()
    {
        return view('about');
    }

    // Page contact
    public function contact()
    {
        return view('contact');
    }
}
