<?php

namespace App\Http\Controllers;


use App\Http\Requests\cakeCreateRequest;
use Illuminate\Http\Request;
use App\Models\cake;
use App\Models\Order;
use App\Models\User;
use App\Exports\CakesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Storage;

class CakeController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

  public function index(Request $request)
{
    $query = cake::query();

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('name', 'like', "%$search%");
    }

    $allCakes = $query->paginate(2); // You can change number of records per page

    $totalCakes = cake::count();
    $totalOrders = Order::count();
    $totalCustomers = User::count();

    return view('cake.index', compact('totalCakes', 'totalOrders', 'totalCustomers', 'allCakes'));
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
    public function export()
{
    return Excel::download(new CakesExport, 'cakes_list.xlsx');
}

public function exportPdf()
{
    $cakes = Cake::all();
    $pdf = Pdf::loadView('pdf.cakes', compact('cakes'));
    return $pdf->download('cakes_list.pdf');
}   
}