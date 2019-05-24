<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
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
        $couriers = Courier::where("status", "1")->get();
        return view("courier.index", compact("couriers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("courier.create");
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
            $name = strtolower($request->name);
            $count = Courier::where("courier", $name)->count();

            if($count == 0){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $courier = new Courier;
                $courier->courier = $name;
                $courier->status = '1';
                $courier->save();

                return redirect()->action('CourierController@index')->with("success", "Successfully create courier");
            }
            return redirect()->action('CourierController@create')->with("warning", "Courier already exists");
        }
        return redirect()->action('CourierController@create')->with("warning", "Please fill in all fields");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show(Courier $courier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit(Courier $courier)
    {
        return view("courier.edit", compact("courier"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courier $courier)
    {
        if(isset($request->name)){
            $name = $request->name;
            $courier_data = Courier::where("courier", $name)->first();

            if($courier->id == $courier_data->id){
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $courier->courier = $name;
                $courier->save();

                return redirect()->action('CourierController@index')->with("success", "Successfully edit courier");
            }
            return redirect()->action('CourierController@edit', ["courier" => $courier])->with("warning", "Courier already exists");
        }
        return redirect()->action('CourierController@edit', ["courier" => $courier])->with("warning", "Please fill in all fields");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        $courier->status = '0';
        $courier->save();
        
        return redirect()->action('CourierController@index')->with("success", "Successfully delete courier");
    }
}
