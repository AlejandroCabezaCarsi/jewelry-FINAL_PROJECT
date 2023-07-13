<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class orderController extends Controller
{
    //CREATE ORDER

    public function createOrder (Request $request){
        try {
            $userID = auth()->user()->id;
            
            $validator = Validator::make($request->all(),[
            
                'product'=>'required'
            ]);



            if($validator->fails()){
                return response()->json($validator->errors(),400);
            };

            $validData = $validator->validated();

            foreach ($validData as $newOrder => $value) {
                
                $order = Order::create([
                    'date' => "2023-07-13 10:38:48",
                    'statusOrder_ID' => 1,
                    'user_ID' => $userID
                ]);
            
                $order->products()->attach($validData['product']);

            }

            return response()->json([
                'message' => 'Order created',
                'data' => $newOrder,
            ], Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            Log::error('Error creating the order ' . $th->getMessage());

            return response()->json([
                'message' => 'Errorcreating the order '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //DELETE USER

    //UPDATE ORDER

    //GET ALL ORDERS

    //GET ONE ORDER 


}
