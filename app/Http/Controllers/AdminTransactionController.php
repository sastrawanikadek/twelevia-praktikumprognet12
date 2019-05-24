<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function verified($id)
    {
        DB::table('transactions')->where("id", $id)->update([
            "status" => "verified"
        ]);

        return redirect()->back()->with("success", "Successfully verified transaction");
    }

    public function delivered($id)
    {
        DB::table('transactions')->where("id", $id)->update([
            "status" => "delivered"
        ]);

        return redirect()->back()->with("success", "Successfully delivered product");
    }

    public function review()
    {
        $reviews = DB::table('product_reviews')
                            ->join("products", "products.id", "=", "product_reviews.product_id")
                            ->join("product_images", "products.id", "=", "product_images.product_id")
                            ->join("users", "users.id", "=", "product_reviews.user_id")
                            ->select("product_reviews.id as review_id", "product_reviews.rate", "product_reviews.content", "products.*", "product_images.image_name", "users.*")
                            ->where("product_reviews.status", "0")
                            ->get();

        return view('responses.index', compact('reviews'));
    }

    public function response(Request $request)
    {
        for ($i=0; $i < count($request->review_id); $i++) { 
            DB::table("response")->insert([
                "review_id" => $request->review_id[$i],
                "admin_id" => Auth::id(),
                "content" => $request->content[$i]
            ]);

            DB::table("product_reviews")->where("id", $request->review_id[$i])->update([
                "status" => "1"
            ]);
        }

        return redirect()->intended("/home")->with("success", "Successfully respond the reviews");
    }
}