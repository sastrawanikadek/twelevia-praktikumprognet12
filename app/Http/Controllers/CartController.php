<?php

namespace App\Http\Controllers;

use App\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check()){
            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->product_id = $request->product_id;
            $cart->qty = 1;
            $cart->status = 'notyet';
            $cart->save();
           
            return redirect()->back();
        } else {
            return redirect()->intended('/login');
        }
    }

    public function destroy($id)
    {
        if(Auth::check()){
            $cart = Cart::find($id);
            $cart->status = 'cancelled';
            $cart->save();
           
            return redirect()->back();
        } else {
            return redirect()->intended('/login');
        }
    }
}
