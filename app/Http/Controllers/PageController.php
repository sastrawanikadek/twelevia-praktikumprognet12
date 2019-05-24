<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use DB;

class PageController extends Controller
{
    public function home()
    {
        $id = Auth::id();

        if(!empty($id)){
            $quantity = Cart::where('user_id', $id)->where("status", "notyet")->sum("qty");
            $carts = Cart::join("products", "carts.product_id", "=", "products.id")
                        ->join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("carts.*", "product_images.image_name", "products.product_name", "products.price", "products.weight")
                        ->where('user_id', $id)
                        ->where('carts.status', 'notyet')
                        ->get();
            return view('pages.home', compact('quantity', 'carts'));
        } else {
            return view('pages.home');
        }
    }

    public function shop()
    {
        $products = Product::join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("products.*", "product_images.image_name")
                        ->where("products.status", "1")
                        ->paginate(15);
        
        $filteredProducts = [];

        for($i = 0; $i < count($products); $i++){
            $status = 0;

            for($j = 0; $j < count($filteredProducts); $j++){
                if($products[$i]->id == $filteredProducts[$j]->id){
                    $status = 1;
                    break;
                }
            }

            if($status == 0){
                array_push($filteredProducts, $products[$i]);
            } else {
                array_splice($products, $i + 1, 1);
            }
        }

        $categories = DB::table('product_categories')->get();

        $id = Auth::id();

        if($id){
            $quantity = Cart::where('user_id', $id)->where("status", "notyet")->sum("qty");
            $carts = Cart::join("products", "carts.product_id", "=", "products.id")
                        ->join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("carts.*", "product_images.image_name", "products.product_name", "products.price", "products.weight")
                        ->where('user_id', $id)
                        ->where('carts.status', 'notyet')
                        ->get();
            return view('pages.shop', compact('products', 'categories', 'quantity', 'carts'));
        } else {
            return view('pages.shop', compact('products', 'categories'));
        }
    }

    public function shopByCategory($type, $category)
    {
        $enum_type = '0';

        switch ($type) {
            case 'Women':
                $enum_type = '1';
                break;
            
            case 'Men':
                $enum_type = '2';
                break;

            case 'Kid':
                $enum_type = '3';
                break;
        }

        $products = Product::join("product_images", "products.id", "=", "product_images.product_id")
                        ->join("product_category_details", "products.id", "=", "product_category_details.product_id")
                        ->join("product_categories", "product_category_details.category_id", "=", "product_categories.id")
                        ->select("products.*", "product_images.image_name")
                        ->where("products.status", "1")
                        ->where("product_categories.category_type", $enum_type)
                        ->where("product_categories.category_name", $category)
                        ->paginate(15);
        
        $filteredProducts = [];

        for($i = 0; $i < count($products); $i++){
            $status = 0;

            for($j = 0; $j < count($filteredProducts); $j++){
                if($products[$i]->id == $filteredProducts[$j]->id){
                    $status = 1;
                    break;
                }
            }

            if($status == 0){
                array_push($filteredProducts, $products[$i]);
            } else {
                array_splice($products, $i + 1, 1);
            }
        }

        $categories = DB::table('product_categories')->get();

        $id = Auth::id();

        if($id){
            $quantity = Cart::where('user_id', $id)->where("status", "notyet")->sum("qty");
            $carts = Cart::join("products", "carts.product_id", "=", "products.id")
                        ->join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("carts.*", "product_images.image_name", "products.product_name", "products.price", "products.weight")
                        ->where('user_id', $id)
                        ->where('carts.status', 'notyet')
                        ->get();
            return view('pages.shop', compact('products', 'type', 'category', 'categories', 'quantity', 'carts'));
        } else {
            return view('pages.shop', compact('products', 'type', 'category', 'categories'));
        }
    }

    public function checkout(Request $request)
    {
        $id = Auth::id();
        $weight = 0;

        if(!empty($id)){
            $quantity = Cart::where('user_id', $id)->where("status", "notyet")->sum("qty");
            $carts = Cart::join("products", "carts.product_id", "=", "products.id")
                        ->join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("carts.*", "product_images.image_name", "products.product_name", "products.price", "products.weight")
                        ->where('user_id', $id)
                        ->where('carts.status', 'notyet')
                        ->get();

            if(isset($request->item)){
                $product = Product::find($request->item);

                $weight += (floatval($product->weight) * 1000);
            } else {
                foreach ($carts as $cart) {
                    $weight += (floatval($cart->weight) * 1000);
                }

                $product = null;
            }

            $client = new GuzzleHttp\Client();
            $req = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                'headers' => [
                    "key" => "85412dc57a748f17205ebbefdeb8710b"
                ]
            ]);

            $response = $req->getBody()->getContents();
            $response = json_decode($response, true);
            $results = $response["rajaongkir"]["results"];

            $couriers = Courier::where("status", "1")->get();

            return view('pages.checkout', compact('quantity', 'carts', 'results', 'weight', 'product', 'couriers'));
        } else {
            return redirect()->intended('/login');
        }
    }

    public function checkoutProduct(Request $request)
    {
        $address = $request->address;
        $province = $request->province;
        $courier = $request->courier;
        $shipping = $request->shipping;
        $regency = $request->regency;
        $product_id = explode(",", $request->product_id);

        
    }

    public function calculateShipping(Request $request)
    {
        $courier = $request->courier;
        $destination = $request->destination;
        $origin = $request->origin;
        $weight = intval($request->weight);

        $client = new GuzzleHttp\Client();
        $req = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                "key" => "85412dc57a748f17205ebbefdeb8710b"
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]
        ]);

        $response = $req->getBody()->getContents();
        $response = json_decode($response, true);
        $results = $response["rajaongkir"]["results"];

        return $results;
    }
}
