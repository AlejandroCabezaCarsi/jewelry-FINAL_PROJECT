<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\Attribute\Required;

class userController extends Controller
{
    //USER REGISTER

    public function register(Request $request){
        try {

            
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'surname' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', Password::min(8)->mixedCase()->numbers()],
                'city' => 'required|string',
                'postalCode' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'role_ID' => 'required',
                'isActive' => 'required'


            ]);

            if($validator->fails()){

                return response()->json($validator->errors(),400);

            };

            $validData = $validator -> validate();

            $newUser = User::create([
                'name'=>$validData['name'],
                'surname'=>$validData['surname'],
                'email'=>$validData['email'],
                'password'=>bcrypt($validData['password']),
                'city' => $validData['city'],
                'postalCode' => $validData['postalCode'],
                'address' => $validData['address'],
                'role_ID'=>$validData['role_ID'],
                'isActive'=>$validData['isActive']
            ]);

            $token = $newUser->createToken('apiToken')->plainTextToken;

            return response()->json([
                'message' => 'User registered',
                'data' => $newUser,
                'token' => $token
            ], Response::HTTP_CREATED);


        } catch (\Throwable $th) {

            Log::error('Error registering user ' . $th->getMessage());

            return response()->json([
                'message' => 'Error registering user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
