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
    public function index($status = 'not-pay')
    {
        $transactions = DB::table("transactions")->where("transactions.user_id", Auth::id())
                        ->where("transactions.timeout", "<", date("Y-m-d H:i:s"))
                        ->where("transactions.status", "notyetpaid")
                        ->update([
                            "status" => "expired"
                        ]);

        if($status == 'not-pay'){
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "notyetpaid")
                            ->get();
        } elseif($status == "unverified"){
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "unverified")
                            ->get();
        } elseif($status == "verified"){
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "verified")
                            ->get();
        } elseif($status == "delivered"){
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "delivered")
                            ->orWhere("transactions.status", "reviewed")
                            ->get();
        } elseif($status == "expired"){
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "expired")
                            ->get();
        } else {
            $transactions = DB::table("transactions")
                            ->where("transactions.user_id", Auth::id())
                            ->where("transactions.status", "cancelled")
                            ->get();
        }
        
        return view('home', compact('transactions'));
    }

    public function profile()
    {
        return view('user.profile');
    }
}
