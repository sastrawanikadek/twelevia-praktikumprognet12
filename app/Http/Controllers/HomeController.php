<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = DB::table("transactions")->join("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
                            ->where("transactions.user_id", Auth::id())
                            ->get();
        $products = Product::join("product_images", "products.id", "=", "product_images.product_id")
                            ->select("products.*", "product_images.image_name")
                            ->get();
        
        return view('home', compact('transactions', 'products'));
    }

    public function profile()
    {
        return view('user.profile');
    }
}
