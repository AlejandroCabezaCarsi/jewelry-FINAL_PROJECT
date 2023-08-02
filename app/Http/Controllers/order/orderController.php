<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StatusOrder;
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
                    'date' => now(),
                    'statusOrder_ID' => 1,
                    'user_ID' => $userID
                ]);
            
                $order->products()->attach($validData['product']);

            }

            return response()->json([
                'message' => 'Order created',
                'data' => $order,
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

    public function updateOrderByID (Request $request){
        try {

            $user = auth()->user();

            if($user->role_ID >3){
                return response()->json([
                    'message' => 'You dont have athoritation to delete a user'
                ], Response::HTTP_UNAUTHORIZED);
            };

            if(!$user){
                return response()->json([
                    'message' => 'User not found'
                ], Response::HTTP_UNAUTHORIZED);
            }; 

            $orderFind = Order::find($request['id']);

            if (!$orderFind) {
                return response()->json([
                    'message' => 'Order not found'
                ]);
            }

            $orderFind->statusOrder_ID = $request['statusOrder_ID']; 

            $orderFind->save();

            return response()->json([
                'message' => 'Order updated'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error updating the order ' . $th->getMessage());

            return response()->json([
                'message' => 'Error updating the order '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ALL ORDERS

    public function getAllOrders(Request $request){
        try {

            $user = auth()->user();

            if($user['role_ID']>3){
                return response()->json([
                    'message' => 'You dont have athoritation to get all orders'
                ], Response::HTTP_UNAUTHORIZED);
            };

            $statusSelected = $request->input('statusOrderSelected'); 

            $query = Order::with('products','statusOrders', 'user'); 

            if ($statusSelected) {
                $query->where('statusOrder_ID', $statusSelected);
                $order = $query->get();
                return response()->json([
                    'message' => 'Orders filtered retrieved',
                    'data' => $order
                ], Response::HTTP_OK);
            }

            $getAllOrders = Order::with('products', 'products.type', 'products.material', 'statusOrders', 'user')->get();

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

    //GET ALL ORDERS BY USER ID

    public function getAllOrdersByUserID(Request $request)
{
    try {


        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $petitionUserID = $user->id;

        $userID = $request->input('id'); 

        $role = $user->role_ID;

        if ($petitionUserID !== $userID){

            if ($role === 1 || $role === 2){

                $getAllOrders = Order::where('user_ID', $userID)
                ->with('products', 'products.type', 'products.material', 'user', 'statusOrders')
                ->get();

                return response()->json([
                    'message' => 'All orders retrieved',
                    'data' => $getAllOrders,
                ], Response::HTTP_OK);

            } else{
                return response()->json([
                    'message' => 'You dont have permission',
                ], Response::HTTP_UNAUTHORIZED);
            }

        }

        $getAllOrders = Order::where('user_ID', $userID)
            ->with('products', 'products.type', 'products.material', 'user', 'statusOrders')
            ->get();

        return response()->json([
            'message' => 'All orders retrieved',
            'data' => $getAllOrders,
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

            $order = Order::with('products')->find($id);

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
