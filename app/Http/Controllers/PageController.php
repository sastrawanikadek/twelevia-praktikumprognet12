<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function shop()
    {
        $products = Product::join("product_images", "products.id", "=", "product_images.product_id")
                        ->select("products.*", "product_images.image_name")
                        ->where("products.status", "1")
                        ->get();
        
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
            }
        }

        return view('pages.shop', compact('filteredProducts'));
    }

    public function shopByCategory($type, $category)
    {
        switch ($type) {
            case 'Women':
                $type = '1';
                break;
            
            case 'Men':
                $type = '2';
                break;

            case 'Kid':
                $type = '3';
                break;
        }

        $products = Product::join("product_images", "products.id", "=", "product_images.product_id")
                        ->join("product_category_details", "products.id", "=", "product_category_details.product_id")
                        ->join("product_categories", "product_category_details.category_id", "=", "product_categories.id")
                        ->select("products.*", "product_images.image_name")
                        ->where("products.status", "1")
                        ->where("product_categories.category_type", $type)
                        ->where("product_categories.category_name", $category)
                        ->get();
        
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
            }
        }

        return view('pages.shop', compact('filteredProducts'));
    }
}
