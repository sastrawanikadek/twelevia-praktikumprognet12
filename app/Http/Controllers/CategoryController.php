<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
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
        $categories = DB::table('product_categories')->where("status", '1')->get();
        return view("category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->name)){
            $name = $request->name;
            $type = $request->type;
            $count = DB::table("product_categories")->where("category_name", $name)->where("category_type", $type)->count();

            if($count == 0){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                
                DB::table("product_categories")->insert(
                    ["category_name" => $name, "category_type" => $type, "status" => "1"]
                );

                return redirect()->action('CategoryController@index')->with("success", "Successfully create category");
            }
            return redirect()->action('CategoryController@create')->with("warning", "Category already exists");
        }
        return redirect()->action('CategoryController@create')->with("warning", "Please fill in all fields");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('product_categories')->find($id);
        return view("category.edit", compact("category"));
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
        if(isset($request->name)){
            $name = $request->name;
            $type = $request->type;
            $category = DB::table("product_categories")->where("category_name", $name)->where("category_type", $type)->first();

            if($category->id == $id){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                
                DB::table("product_categories")->where("id", $id)->update(
                    ["category_name" => $name]
                );

                return redirect()->action('CategoryController@index')->with("success", "Successfully edit category");
            }
            return redirect()->action('CategoryController@edit', ["id" => $id])->with("warning", "Category already exists");
        }
        return redirect()->action('CategoryController@edit', ["id" => $id])->with("warning", "Please fill in all fields");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("product_categories")->where("id", $id)->update(["status" => "0"]);
        return redirect()->action('CategoryController@index')->with("success", "Successfully delete category");
    }
}
