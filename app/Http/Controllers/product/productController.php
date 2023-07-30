<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class productController extends Controller
{
    //GET ALL PRODUCTS 

    public function getAllProducts()
    {
        try {
            
            $getAllProducts = Product::with('material','type')->get();

            return response()->json([
                'message' => 'All products retrieved',
                'data' => $getAllProducts
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            //throw $th;
        };
        
    }



//GET ALL PRODUCTS FILTERED

public function getAllProductsFiltered(Request $request)
{
        try {
        
            $typeSelected = $request->input('typeSelected'); 
            $name = $request->input('name'); 
            $diamonds = $request->input('diamonds');

            $query = Product::query(); 

            if ($typeSelected) {
                $query->where('type_ID', $typeSelected);
            }
            
            if ($name) {
                $query->where(function ($q) use ($name) {
                    $q->where('name', 'like', "%$name%")
                      ->orWhere('description', 'like', "%$name%");
                });
            }

            if($diamonds){
                $query->where('diamonds', $diamonds);
            }

            $product = $query->get();


            return response()->json([
                'message' => 'Products filtered retrieved',
                'data' => $product
            ], Response::HTTP_OK);
    } catch (\Throwable $th) {
        //throw $th;
    }
}
}


