<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class DiscountController extends Controller
{
    /* Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
       $this->middleware("auth:admin");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = Product::find($request->id);
        $discounts = DB::table("discounts")->where("id_product", $request->id)->get();
        return view("discounts.create", compact("product", "discounts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id && $request->discount && $request->start && $request->end){
            if($request->start <= $request->end){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                
                DB::table("discounts")->insert(
                    ["id_product" => $request->id, "percentage" => $request->discount, "start" => $request->start, "end" => $request->end]
                );

                return redirect()->action('DiscountController@show', ["id" => $request->id])->with("success", "Successfully create discount");
            }
            return redirect()->back()->with("warning", "End date must be bigger than start date");
        }
        return redirect()->back()->with("warning", "Please fill in all fields");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $discounts = DB::table("discounts")->where("id_product", $id)->get();
        return view('discounts.show', compact("product","discounts"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = DB::table("discounts")->where("id", $id)->first();
        $product = Product::find($discount->id_product);

        return view('discounts.edit', compact("product","discount"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->id && $request->discount && $request->start && $request->end){
            if($request->start <= $request->end){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                
                DB::table("discounts")->where("id", $id)->update(
                    ["percentage" => $request->discount, "start" => $request->start, "end" => $request->end]
                );

                return redirect()->action('DiscountController@show', ["id" => $request->id])->with("success", "Successfully edit discount");
            }
            return redirect()->back()->with("warning", "End date must be bigger than start date");
        }
        return redirect()->back()->with("warning", "Please fill in all fields");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('discounts')->where('id', $id)->delete();
        return redirect()->back()->with("success", "Successfully delete discount");
    }
}
