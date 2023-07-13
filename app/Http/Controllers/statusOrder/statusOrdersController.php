<?php

namespace App\Http\Controllers\statusOrder;

use App\Http\Controllers\Controller;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class statusOrdersController extends Controller
{
    //CREATE STATUS ORDER

    public function  createStatusOrder(Request $request){

        try {

            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to create a material'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };
            
            $validator = Validator::make($request->all(),[
                'name' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),400);
            };

            $validData = $validator -> validate();

            $newStatusOrder = StatusOrder::create([
                'name'=>$validData['name'] 
            ]);

            $newStatusOrder -> save();

            return response()->json([
                'message' => 'Status order created',
                'data' => $newStatusOrder
            ], Response::HTTP_CREATED);


        } catch (\Throwable $th) {
            Log::error('Error creating status order ' . $th->getMessage());

            return response()->json([
                'message' => 'Error creating status order'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
