<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserTransactionController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        \Cloudinary::config(array(
            "cloud_name" => "dbpbpokhx",
            "api_key" => "224568426731156",
            "api_secret" => "BrRWdDBVJlaS1f8zmbUNNTk6Ymg"
        ));
    }

    public function create($id)
    {
        return view("user.upload-payment", compact("id"));
    }

    public function store(Request $request, $id)
    {
        if(isset($request->profile_image)){
            if($request->file("profile_image")->extension() == "jpg" || $request->file("profile_image")->extension() == "png" || 
            $request->file("profile_image")->extension() == "jpeg"){
                if(($request->file("profile_image")->getSize() / 1000) <= 1024){
                    $upload = \Cloudinary\Uploader::upload($request->file("profile_image"));

                    DB::table('transactions')->where("id", $id)->update([
                        "proof_of_payment" => $upload["secure_url"],
                        "status" => "unverified"
                    ]);
                    return redirect()->intended("/home");
                }
                return redirect()->back()->with("warning", "Maximum size is 1MB");
            }
            return redirect()->back()->with("warning", "Only jpg, jpeg, or png are allowed");
        }
        return redirect()->back()->with("warning", "Please fill in all fields");
    }

    public function show($id)
    {
        $transactions = DB::table('transactions')->join("transaction_details", "transactions.id", "=", "transaction_details.transaction_id")
                            ->join("products", "products.id", "=", "transaction_details.product_id")
                            ->join("product_images", "products.id", "=", "product_images.product_id")
                            ->select("transaction_details.real_price", "transaction_details.selling_price", "transaction_details.discount", "products.*", "product_images.image_name")
                            ->where("transactions.id", $id)
                            ->get();

        return view('user.review', compact('transactions', 'id'));
    }

    public function review(Request $request, $id)
    {
        for ($i=0; $i < count($request->product_id); $i++) { 
            DB::table("product_reviews")->insert([
                "product_id" => $request->product_id[$i],
                "user_id" => Auth::id(),
                "rate" => $request->rating[$i],
                "content" => isset($request->content[$i]) ? $request->content[$i] : "",
                "status" => "0"
            ]);
        }

        DB::table("transactions")->where("id", $id)->update([
            "status" => "reviewed"
        ]);

        return redirect()->intended("/home")->with("success", "Successfully review the products");
    }

    public function destroy($id)
    {
        DB::table("transactions")->where("id", $id)->update([
            "status" => "cancelled"
        ]);

        return redirect()->back();
    }
}
