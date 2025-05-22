<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cake;

class ChocolateController extends Controller
{
    public function index()
    {
    
        
        $allcakes = cake::get();
        return view('chocolate',compact('allcakes'));
    }

}
