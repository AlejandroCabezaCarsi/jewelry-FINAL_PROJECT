<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    //USER LOGIN


    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ], [
                'email'=> 'Email or password are invalid',
                'password' => 'Email or password are invalid'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }

            $validData = $validator->validated();

            $user = User::where('email', $validData['email'])->first();

            if(!$user){
                return response()->json([
                    'message' => 'Email or password are invalid'
                ], Response::HTTP_FORBIDDEN);
            }

            if(!Hash::check($validData['password'], $user->password)){
                return response()->json([
                    'message' => 'Email or password are invalid'
                ], Response::HTTP_FORBIDDEN);
            }

            $token = $user->createToken('apiToken')->plainTextToken;

            return response()->json([
                'message' => 'User logged',
                'token' => $token
            ], Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            Log::error('Error logging user in ' . $th->getMessage());

            return response()->json([
                'message' => 'Error logging user in'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //USER UPDATE

    public function updateMyAccount(Request $request){

        try {
            
            $validator = Validator::make($request->all(),[
                'name' => 'string',
                'surname' => 'string',
                'email'=>'string',
                'city'=>'string',
                'postalCode' => 'string',
                'address' => 'string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }; 

            $validData = $validator->validated();

            $user = auth()->user();
            
            $userFind = User::find($user['id']);

            if (!$userFind) {
                return response()->json([
                    'message' => 'User not found'
                ]);
            }

            if (isset($validData['name'])) {
                $userFind->name = $validData['name'];
            }

            if (isset($validData['surname'])) {
                $userFind->surname = $validData['surname'];
            }
            if (isset($validData['email'])) {
                $userFind->email = $validData['email'];
            }
            if (isset($validData['city'])) {
                $userFind->city = $validData['city'];
            }
            if (isset($validData['postalCode'])) {
                $userFind->postalCode = $validData['postalCode'];
            }
            if (isset($validData['address'])) {
                $userFind->address = $validData['address'];
            }

            $userFind->save();

            return response()->json([
                'message' => 'User updated'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {

            Log::error('Error updating the user ' . $th->getMessage());

            return response()->json([
                'message' => 'Error updating the user '
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    //UPDATE PASSWORD

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
    
        $user = auth()->user();
    
        if (!$user instanceof User) {
            return response()->json(['message' => 'Usuario no válido'], Response::HTTP_BAD_REQUEST);
        }
    
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            Log::info('Contraseña actualizada correctamente');
            return response()->json(['message' => 'Contraseña actualizada correctamente'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Contraseña antigua incorrecta'], Response::HTTP_UNAUTHORIZED);
        }
    }

    //USER DESTROY

    public function destroyAccount(Request $request)
    {
        try {
            $userPetition = auth()->user();
        
            if (!$userPetition) {
                return response()->json([
                    'message' => 'User not found'
                ], Response::HTTP_UNAUTHORIZED);
            }
        
            $user = User::withTrashed()->find($request->input('id'));
        
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], Response::HTTP_NOT_FOUND);
            }
        
            $user->forceDelete(); 
        
            return response()->json([
                'message' => 'User permanently deleted'
            ], Response::HTTP_OK);
        
        } catch (\Throwable $th) {
            Log::error('Error deleting user: ' . $th->getMessage());
        
            return response()->json([
                'message' => 'Error deleting user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //USER SOFT DELETE

    public function deleteMyAccount(){
        try {

            $user = auth()->user();

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };

            User::destroy($user->id);

            return response()->json([
                'message'=>'User deleted'
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error deleting user ' . $th->getMessage());

            return response()->json([
                'message' => 'Error deleting user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //USER RESTORE

    public function restoreAccount(Request $request){
        try {

            $user = auth()->user();

            if (!$user) {
                return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_UNAUTHORIZED);
            }

            // if($user['role_ID']!= 1 || 2){
            //     return response()->json([
            //         'message' => 'You dont have athoritation to delete a user'
            //     ], Response::HTTP_UNAUTHORIZED);
            // };
            
            $id = $request->input('id');
            User::withTrashed()->where('id',$id)->restore();

            return response()->json([
                'message'=>'User restored'
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error restoring user ' . $th->getMessage());

            return response()->json([
                'message' => 'Error restoring user'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    //USER GET ALL WITHOUT SOFT DELETES

    public function getAllUsers(){
        try {
            
            $user = auth()->user(); 

            // if($user['role_ID'] > 3){
            //     return response()->json([                
            //     'message' => 'You dont have athoritation to get all users'               
            // ], Response::HTTP_UNAUTHORIZED);
            // }

            $getAllUsers = User::with('role')->get();

            return response()->json([
                'message' => 'All users retrieved',
                'data' => $getAllUsers
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving users ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving users'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ONE USER BY TOKEN


    public function getOneUserByToken(){
        try {
            
            $user = Auth::user();

            return response()->json([
                'message' => 'User retrieved',
                'data' => $user
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving users ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving users'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ALL USERS FILTERED

public function getAllUsersFiltered(Request $request)
    {

        $user = auth()->user();

        if (!$user) {
            return response()->json([
            'message' => 'User not found'
        ], Response::HTTP_UNAUTHORIZED);
        }

        $roleSelected = $request->input('roleSelected');
        $nameOrEmail = $request->input('nameOrEmail');

        $query = User::query();

        if ($roleSelected || $nameOrEmail) {
            $query->with('role');
        }

        if ($roleSelected) {
            $query->where('role_id', $roleSelected);
        }

        if ($nameOrEmail) {
            $query->where(function ($q) use ($nameOrEmail) {
                $q->where('name', 'like', "%$nameOrEmail%")
                  ->orWhere('email', 'like', "%$nameOrEmail%")
                  ->orWhere('surname', 'like', "%$nameOrEmail%");
            });
        }

        $users = $query->get();

        return response()->json(['data' => $users]);
    }

    //GET ALL DELETED USERS

    public function getAllDeletedUsers()
    {
        try {
            $user = auth()->user();
    
            if (!$user) {
                return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_UNAUTHORIZED);
            }
    
            
        $deletedUsers = User::onlyTrashed()->with('role')->get();


    
            return response()->json([
                'message' => 'User retrieved',
                'data' => $deletedUsers
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error retrieving users ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving users'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ONE USER BY HIS ID 

    public function getUserDataByID(Request $request) 
    {
        try {

            $id = $request->input('id'); 

            $user = auth()->user();
    
            if (!$user) {
                return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_UNAUTHORIZED);
            };

            $userData = User::with('role')->where('id', $id )->get();

            return response()->json([
                'message' => 'User retrieved',
                'data' => $userData
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            Log::error('Error retrieving user ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving users'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET ONE DELETED USER BY ID

    public function getOneDeletedUserByID (Request $request)
    {
        try{

        $user = auth()->user();
    
        if (!$user) {
            return response()->json([
            'message' => 'User not found'
        ], Response::HTTP_UNAUTHORIZED);
        }

        $deletedUsers = User::onlyTrashed()->with('role')->where('id', $request->input('id'))->get();


    
            return response()->json([
                'message' => 'User retrieved',
                'data' => $deletedUsers
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error retrieving users ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving users'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    
}
