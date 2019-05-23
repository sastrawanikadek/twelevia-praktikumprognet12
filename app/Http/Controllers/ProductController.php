<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use DB;

class ProductController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table("products")->where("products.status", "1")
                    ->join("product_category_details", "product_category_details.product_id", "=", "products.id")
                    ->join("product_categories", "product_category_details.category_id", "=", "product_categories.id")
                    ->select("products.*", "product_categories.category_name")
                    ->get();

        $newProducts = [];
        
        for($i = 0; $i < count($products); $i++){
            $status = 0;

            for($j = 0; $j < count($newProducts); $j++){
                if($products[$i]->id == $newProducts[$j]->id){
                    $newProducts[$j]->category_name .= ",";
                    $newProducts[$j]->category_name .= $products[$i]->category_name;
                    $status = 1;
                    break;
                }
            }

            if($status == 0){
                array_push($newProducts, $products[$i]);
            }
        }

        return view('product.index', compact('newProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('product_categories')->where("status", "1")->get();
        return view('product.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->name) && isset($request->categories) && isset($request->price) && isset($request->stock) && isset($request->weight) && isset($request->description)){
            $name = $request->name; 
            $price = str_replace(".", "", $request->price);
            $stock = $request->stock;
            $weight = $request->weight;
            $description = $request->description;
            $categories = $request->categories;

            if($price > 0 && $stock > 0 && preg_match("/^[0-9]+\.?[0-9]*$/", $weight)){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $product = new Product;
                $product->product_name = $name;
                $product->price = $price;
                $product->description = $description;
                $product->product_rate = 0;
                $product->stock = $stock;
                $product->weight = $weight;
                $product->status = '1';
                $product->save();

                foreach ($categories as $category => $value) {
                    DB::table("product_category_details")->insert(
                        ["product_id" => $product->id, "category_id" => $value]
                    );  
                }

                return redirect()->action('ProductController@index')->with("success", "Successfully create product");
            }
            return redirect()->action('ProductController@create')->with("warning", "Price, Stock, and Weight must be more than 0");
        }
        return redirect()->action('ProductController@create')->with("warning", "Please fill in all fields");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $products = DB::table("products")->where("products.status", "1")->where("products.id", $product->id)
                    ->join("product_category_details", "product_category_details.product_id", "=", "products.id")
                    ->join("product_categories", "product_category_details.category_id", "=", "product_categories.id")
                    ->select("products.*", "product_categories.id as category_id")
                    ->get();

        $newProducts = [];

        for($i = 0; $i < count($products); $i++){
            $status = 0;

            for($j = 0; $j < count($newProducts); $j++){
                if($products[$i]->id == $newProducts[$j]->id){
                    $newProducts[$j]->category_id .= ",";
                    $newProducts[$j]->category_id .= $products[$i]->category_id;
                    $status = 1;
                    break;
                }
            }

            if($status == 0){
                array_push($newProducts, $products[$i]);
            }
        }

        $newProducts[0]->category_id = explode(",", $newProducts[0]->category_id);

        $categories = DB::table('product_categories')->where("status", "1")->get();

        return view('product.edit', compact("newProducts", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if(isset($request->name) && isset($request->categories) && isset($request->price) && isset($request->stock) && isset($request->weight) && isset($request->description)){
            $name = $request->name;
            $price = str_replace(".", "", $request->price);
            $stock = $request->stock;
            $weight = $request->weight;
            $description = $request->description;
            $categories = $request->categories;

            if($price > 0 && $stock > 0 && preg_match("/^[0-9]+\.?[0-9]*$/", $weight)){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $product->product_name = $name;
                $product->price = $price;
                $product->description = $description;
                $product->stock = $stock;
                $product->weight = $weight;
                $product->save();

                $product_category_details = DB::table('product_category_details')->where("product_id", $product->id)->get();

                foreach ($product_category_details as $key => $item) {
                    if(!in_array($item->category_id, $categories)){
                        DB::table('product_category_details')->where('product_id', $product->id)->where('category_id', $item->category_id)->delete();
                    }
                }

                foreach ($categories as $key => $value) {
                    $status = 0;

                    foreach ($product_category_details as $key => $item) {
                        if($item->category_id == $value){
                            $status = 1;
                        }
                    }

                    if($status == 0){
                        DB::table("product_category_details")->insert(
                            ["product_id" => $product->id, "category_id" => $value]
                        );
                    }
                }

                return redirect()->action('ProductController@index')->with("success", "Successfully edit product");
            }
            return redirect()->action('ProductController@edit', ["product" => $product])->with("warning", "Price, Stock, and Weight must be more than 0");
        }
        return redirect()->action('ProductController@edit', ["product" => $product])->with("warning", "Please fill in all fields");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->status = '0';
        $product->save();

        DB::table('product_category_details')->where("product_id", $product->id)->delete();

        return redirect()->action('ProductController@index')->with("success", "Successfully delete product");
    }
}
