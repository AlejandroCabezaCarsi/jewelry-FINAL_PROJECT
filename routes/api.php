<?php

use App\Http\Controllers\materials\materialsController;
use App\Http\Controllers\type\typeController;
use App\Http\Controllers\user\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//USER ROUTES

Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);
Route::delete('/delete', [userController::class, 'deleteMyAccount'])->middleware('auth:sanctum');
Route::put('/update', [userController::class, 'updateMyAccount'])->middleware('auth:sanctum');
Route::get('/getAllUsers', [userController::class, 'getAllUsers'])->middleware('auth:sanctum');

//MATERIAL ROUTES 

Route::post('/createMaterial', [materialsController::class, 'createMaterial'])->middleware('auth:sanctum');
Route::delete('/deleteMaterial/{id}', [materialsController::class, 'deleteMaterialByID'])->middleware(('auth:sanctum'));
Route::put('/updateMaterial/{id}', [materialsController::class, 'updateMaterial'])->middleware('auth:sanctum');
Route::get('/getAllMaterials', [materialsController::class, 'getAllMaterials'])->middleware('auth:sanctum');
Route::get('/getOneMaterial/{id}', [materialsController::class, 'getOneMaterialByID'])->middleware('auth:sanctum');

//TYPE ROUTES 

Route::post('/createType', [typeController::class, 'createType'])->middleware('auth:sanctum');
Route::delete('/deleteType/{id}', [typeController::class, 'deleteTypeByID'])->middleware(('auth:sanctum'));
Route::put('/updateType/{id}', [typeController::class, 'updateType'])->middleware('auth:sanctum');
