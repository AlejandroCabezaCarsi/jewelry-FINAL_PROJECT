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

    public function getAllOrders(){
        try {

            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            $getAllOrders = Order::with('product', 'product.type', 'product.material')->get();

            return response()->json([
                'message' => 'All orders retrieved',
                'data' => $getAllOrders
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving orders ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving orders'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ALL ORDERS

    public function getAllOrdersByUserID(){
        try {
            $user = auth()->user();
    
            if (!$user) {
                return response()->json([
                    'message' => 'User not authenticated'
                ], Response::HTTP_UNAUTHORIZED);
            }
    
            $userID = $user->id;
    
            $getAllOrders = Order::where('user_id', $userID)
                ->with('product', 'product.type', 'product.material')
                ->get();
                
    
            return response()->json([
                'message' => 'All orders retrieved',
                'data' => $getAllOrders
            ], Response::HTTP_OK);
    
        } catch (\Throwable $th) {
            Log::error('Error retrieving orders ' . $th->getMessage());
    
            return response()->json([
                'message' => 'Error retrieving orders'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ONE ORDER 

    public function getOneOrder($id){
        try {


            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            $order = Order::with('product')->find($id);

            return response()->json([
                'message' => 'All orders retrieved',
                'data' => $order
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving orders ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving orders'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
