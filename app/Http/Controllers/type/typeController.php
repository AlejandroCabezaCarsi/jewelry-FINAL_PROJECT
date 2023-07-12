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

    public function updateType(Request $request, $id){
        try {

            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            $validator = Validator::make($request->all(),[
                'name'=>'string'
            ]);
            
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            };

            $validData = $validator->validated();

            $typeFind = Type::find($id);

            if (!$typeFind) {
                return response()->json([
                    'message' => 'Material not found'
                ]);
            }

            $typeFind->name = $validData['name'];


            $typeFind -> save();

            
            return response()->json([
                'message' => 'Type updated'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error updating the type ' . $th->getMessage());

            return response()->json([
                'message' => 'Error updating the type '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // GET ALL TYPES

    public function getAllTypes(){
        try {
            
            $user = auth()->user(); 

            // if($user['role_ID'] > 3){
            //     return response()->json([                
            //     'message' => 'You dont have athoritation to get all users'               
            // ], Response::HTTP_UNAUTHORIZED);
            // }

            $getAllTypes = Type::all();

            return response()->json([
                'message' => 'All types retrieved',
                'data' => $getAllTypes
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving materials ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving materials'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ONE TYPE BY ID

    public function getOneTypeByID($id){
        try {
            $user = auth()->user(); 

            // if($user['role_ID'] > 3){
            //     return response()->json([                
            //     'message' => 'You dont have athoritation to get all users'               
            // ], Response::HTTP_UNAUTHORIZED);
            // }

            $typeFind = Type::find($id);

            if (!$typeFind) {
                return response()->json([
                    'message' => 'Type not found'
                ]);
            }

            return response()->json([
                'message' => 'Type retrieved',
                'data' => $typeFind
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error retrieving the type ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving the type '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
