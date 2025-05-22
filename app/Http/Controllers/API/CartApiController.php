<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\cake;
use Illuminate\Support\Facades\Auth;
class CartApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        return response()->json($cart);
    }

    public function add($cake_id)
    {
        $user = Auth::user();
        $cake = cake::findOrFail($cake_id);

        $cart = new Cart([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'address' => $user->address,
            'contact_number' => $user->contact_number,
            'cake_id' => $cake->id,
            'cake_name' => $cake->name,
            'price' => $cake->price,
            'image' => $cake->image,
        ]);
        $cart->save();

        return response()->json(['message' => 'Cake added to cart']);
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['message' => 'Item removed']);
    }

    public function placeOrder()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        foreach ($carts as $cart) {
            Order::create([
                'user_name' => $cart->user_name,
                'address' => $cart->address,
                'contact_number' => $cart->contact_number,
                'user_id' => $cart->user_id,
                'cake_id' => $cart->cake_id,
                'cake_name' => $cart->cake_name,
                'price' => $cart->price,
                'image' => $cart->image,
                'payment_status' => 'cash on delivery',
                'delivery_status' => 'processing',
            ]);

            $cart->delete();
        }

        return response()->json(['message' => 'Order placed']);
    }
}

