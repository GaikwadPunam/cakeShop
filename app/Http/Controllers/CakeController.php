<?php

namespace App\Http\Controllers;


use App\Http\Requests\cakeCreateRequest;
use Illuminate\Http\Request;
use App\Models\cake;
use App\Models\Order;

use Illuminate\Support\Facades\Storage;

class CakeController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(){
        $allCakes = cake::get();
        return view('cake.index',compact( 'allCakes'));

    }
    

    public function store(cakeCreateRequest $request){
           
        
        $path = $request->file('image')->store('cake', 'public');

        cake::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path,
             ]);
             return redirect()->route('cake.index')->with('message', ' Stored   successfully!');



    }


    public function create(){
        return view('cake.create');
    }

    public function edit($id){
        $onerow = cake::find($id);
        return view('cake.edit', compact('onerow'));

    }


    public function destroy($id){
        
         cake::find($id)->delete();

         return redirect()->route('cake.index')->with('success', 'Product deleted  successfully');
    }



    public function update(Request $request, $id)
    {


        
        $onerowupdate = cake::find($id);

        if ($request->has('image')) {
            $path = $request->file('image')->store('cake', 'public');

        }
        else{
            $path = $onerowupdate->image;
        }

        $onerowupdate->fill($request->input());
        $onerowupdate->name = $request->name;
        $onerowupdate->description = $request->description;
        $onerowupdate->price = $request->price;
        $onerowupdate->image = $path;
        $onerowupdate->save();
        return redirect()->route('cake.index')->with('success', 'Product updated successfully');
    }


    public function order()
    {
        $order=Order::all();
        return view('cake.order', compact('order'));

    }
}