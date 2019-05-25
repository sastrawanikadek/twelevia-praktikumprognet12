<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:admin");
    }

    public function index()
    {
        return view("dashboard");
    }

    public function report(Request $request)
    {
        $year = $request->year;
        $monthName = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $transactions = [];

        for ($i=1; $i <= 12 ; $i++) { 
            $transaction = DB::table("transactions")->whereMonth("created_at", $i)->whereYear("created_at", $year)->whereIn("status", ["delivered", "reviewed"])->sum("total");
            $data = (object) ["y" => $monthName[$i - 1], "Value" => $transaction];
            array_push($transactions, $data);
        }

        return $transactions;
    }
}
