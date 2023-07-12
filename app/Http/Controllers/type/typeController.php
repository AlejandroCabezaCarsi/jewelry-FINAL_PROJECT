<?php

namespace App\Http\Controllers\type;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class typeController extends Controller
{
    //CREATE TYPE 

    public function  createType(Request $request){

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

            $newMaterial = Type::create([
                'name'=>$validData['name'] 
            ]);

            $newMaterial -> save();

            return response()->json([
                'message' => 'Material created',
                'data' => $newMaterial
            ], Response::HTTP_CREATED);


        } catch (\Throwable $th) {
            Log::error('Error creating material ' . $th->getMessage());

            return response()->json([
                'message' => 'Error creating material'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    //DELETE TYPE

    public function deleteTypeByID(Request $request){

        try {
            
            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            $findType = Type::find($request->id);

            if(!$findType){
                return response()->json([
                    'message' => 'Type not found'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            Type::destroy($request->id);
            
            return response()->json([
                'message'=>'Type deleted'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error deleting type ' . $th->getMessage());

            return response()->json([
                'message' => 'Error deleting type '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //UPDATE TYPE BY ID 

    // GET ALL TYPES

    //GET ONE TYPE BY ID 
}
