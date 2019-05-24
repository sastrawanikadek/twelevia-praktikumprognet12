<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class ProductImageController extends Controller
{
            /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:admin");
        \Cloudinary::config(array(
            "cloud_name" => "dbpbpokhx",
            "api_key" => "224568426731156",
            "api_secret" => "BrRWdDBVJlaS1f8zmbUNNTk6Ymg"
        ));
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
        return view("product-image.create", compact("product"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->image) && isset($request->id) && isset($request->name)){
            if($request->file("image")->extension() == "jpg" || $request->file("image")->extension() == "png" || 
            $request->file("image")->extension() == "jpeg"){
                if(($request->file("image")->getSize() / 1000) <= 1024){
                    date_default_timezone_set('Asia/Kuala_Lumpur');

                    try {
                        $upload = \Cloudinary\Uploader::upload($request->file("image"));

                        DB::table("product_images")->insert(
                            ["product_id" => $request->id, "image_name" => $upload["secure_url"]]
                        );
                        
                        return redirect()->action("ProductImageController@show", ["id" => $request->id])->with("success", "Successfully create product image");
                    } catch (\Throwable $th) {
                        return redirect()->back()->with("error", "Please try again");
                    }
                }
                return redirect()->back()->with("warning", "Maximum size is 1MB");
            }
            return redirect()->back()->with("warning", "Only jpg, jpeg, or png are allowed");
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
        $products = Product::where('status', '1')->get();
        $images = DB::table('product_images')->where("product_id", $id)->get();
        return view('product-image.show', compact("products", "images", "id"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_image = DB::table('product_images')->find($id);
        $product = Product::find($product_image->product_id);
        return view("product-image.edit", compact("product", "id"));
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
        if(isset($request->image) && isset($request->id) && isset($request->name)){
            if($request->file("image")->extension() == "jpg" || $request->file("image")->extension() == "png" || 
            $request->file("image")->extension() == "jpeg"){
                if(($request->file("image")->getSize() / 1000) <= 1024){
                    date_default_timezone_set('Asia/Kuala_Lumpur');

                    try {
                        $product_image = DB::table("product_images")->find($id);
                        $filename = explode("/", $product_image->image_name)[count(explode("/", $product_image->image_name)) - 1];
                        $public_id = explode(".", $filename)[0];
                        \Cloudinary\Uploader::destroy($public_id);

                        $upload = \Cloudinary\Uploader::upload($request->file("image"));

                        DB::table("product_images")->where("id", $id)->update(["image_name" => $upload["secure_url"]]);
                        
                        return redirect()->action("ProductImageController@show", ["id" => $request->id])->with("success", "Successfully edit product image");
                    } catch (\Throwable $th) {
                        return redirect()->back()->with("error", "Please try again");
                    }
                }
                return redirect()->back()->with("warning", "Maximum size is 1MB");
            }
            return redirect()->back()->with("warning", "Only jpg, jpeg, or png are allowed");
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
        $product_image = DB::table("product_images")->find($id);
        $filename = explode("/", $product_image->image_name)[count(explode("/", $product_image->image_name)) - 1];
        $public_id = explode(".", $filename)[0];
        \Cloudinary\Uploader::destroy($public_id);
        
        DB::table('product_images')->where('id', $id)->delete();
        return redirect()->back()->with("success", "Successfully delete product image");
    }
}
