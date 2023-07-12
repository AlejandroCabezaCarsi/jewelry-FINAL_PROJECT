<?php

namespace App\Http\Controllers\materials;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class materialsController extends Controller
{
    //CREATE MATERIAL

    public function  createMaterial(Request $request){

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

            $newMaterial = Material::create([
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

    //DELETE MATERIAL

    public function deleteMaterialByID(Request $request){

        try {
            
            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            $findMaterial = Material::find($request->id);

            if(!$findMaterial){
                return response()->json([
                    'message' => 'Material not found'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            Material::destroy($request->id);
            
            return response()->json([
                'message'=>'Material deleted'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error deleting material ' . $th->getMessage());

            return response()->json([
                'message' => 'Error deleting material '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //UPDATE MATERIAL

    public function updateMaterial(Request $request, $id){
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

            $materialFind = Material::find($id);

            if (!$materialFind) {
                return response()->json([
                    'message' => 'Material not found'
                ]);
            }

            $materialFind->name = $validData['name'];


            $materialFind -> save();

            
            return response()->json([
                'message' => 'Material updated'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error updating the material ' . $th->getMessage());

            return response()->json([
                'message' => 'Error updating the material '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ALL MATERIALS

    //GET ONE MATERIAL BY ID 
}
