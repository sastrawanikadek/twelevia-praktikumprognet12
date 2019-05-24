<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
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

    public function destroy($id)
    {
        DB::table("transactions")->where("id", $id)->update([
            "status" => "cancelled"
        ]);

        return redirect()->back();
    }
}
