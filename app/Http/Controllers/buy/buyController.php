<?php

namespace App\Http\Controllers\buy;

use App\Http\Controllers\Controller;
use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class buyController extends Controller
{
    //GET ALL BUYS 

    public function getAllBuys(){
        try {

            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            DB::statement('SET SESSION sql_mode = ""');

            $getAllBuys = Buy::groupBy('order_ID')->get();

            DB::statement('SET SESSION sql_mode = "ONLY_FULL_GROUP_BY"');


            return response()->json([
                'message' => 'All buys retrieved',
                'data' => $getAllBuys
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving buys ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving buys'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
