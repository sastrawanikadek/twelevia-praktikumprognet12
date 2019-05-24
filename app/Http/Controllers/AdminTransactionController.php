<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminTransactionController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $transactions = DB::table("transactions")->join("couriers", "transactions.courier_id", "=", "couriers.id")
                            ->select("transactions.*", "couriers.courier")
                            ->get();
        return view("transactions.index", compact("transactions"));
    }
}