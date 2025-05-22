<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cake;

class WelcomeController extends Controller
{
    public function index()
    {
    
        $allcakes = cake::get();
        return view('welcome',compact('allcakes'));
    }

}
