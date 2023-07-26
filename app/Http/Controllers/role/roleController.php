<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class roleController extends Controller
{
    public function getAllRoles(){
        try {
            
            $user = auth()->user(); 

            // if($user['role_ID'] > 3){
            //     return response()->json([                
            //     'message' => 'You dont have athoritation to get all users'               
            // ], Response::HTTP_UNAUTHORIZED);
            // }

            $getAllRoles = Role::all();

            return response()->json([
                'message' => 'All roles retrieved',
                'data' => $getAllRoles
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving materials ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving materials'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}


