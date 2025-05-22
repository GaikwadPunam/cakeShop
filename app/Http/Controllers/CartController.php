<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

use App\Models\cake; // Assuming you have a Cake model

class CartController extends Controller
{
    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {
            $user=Auth::user();
        $cake=cake::find($id);

        
    
            $data = new Cart;
            $data->user_id = $user->id;

            $data->user_name = $user->name;
            $data->address = $user->address;
            $data->contact_number = $user->contact_number;

            $data->cake_id = $cake->id;
            $data->cake_name = $cake->name;

            $data->price = $cake->price;
            $data->image = $cake->image;
            $data->save();
    
            return redirect()->back()->with('success', 'Cake added to cart');
    }
    else{
        return redirect('login');


    }
}
        public function cart(){



        if (Auth::check()) {
            $user_id = Auth::id();
            $data = Cart::where('user_id', $user_id)->get();
            return view('cart', compact('data'));
        } else {
            return redirect()->route('login')->with('error', 'You need to log in first');
        }
        }
        public function remove_cart($id){
            $data=Cart::find($id);
             $data->delete();
             return redirect()->back();
        }


public function cash_order()
{
    $user = Auth::user();
    $userid = $user->id;

    DB::beginTransaction();

    try {
        $cart_items = Cart::where('user_id', $userid)->get();

        foreach ($cart_items as $item) {
            $order = new Order;

            $order->user_name = $item->user_name;
            $order->address = $item->address;
            $order->contact_number = $item->contact_number;
            $order->user_id = $item->user_id;
            $order->cake_name = $item->cake_name;
            $order->cake_id = $item->cake_id;
            $order->price = $item->price;
            $order->image = $item->image;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            // Delete from cart
            $item->delete();
        }

        DB::commit();

        return redirect()->back()->with('message', 'We have received your order. We will contact you soon.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}



public function my_order(){
    if(Auth::id()) {
        $user = Auth::user();
        $userid = $user->id;

        $order = Order::where('user_id', $userid)->get();

        return view('my_order', compact('order'));
    } else {
        return redirect('login');
    }
}






public function delivered($id){
    $order=Order::find($id);
    $order->delivery_status="delivered";
    $order->payment_status="paid";

    $order->save();
    return redirect()->back();
}


public function cancel_order($id){

    
    $order=Order::find($id);
    if ($order->delivery_status == "delivered") {
        return redirect()->back()->with('error', 'Order is already delivered and cannot be canceled.');
    }


    $order->delivery_status="you cancel the order";
      $order->save();
      return redirect()->back();

}
}

