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
        }
        
    }
}
