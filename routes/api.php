<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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

Route::get('students',[StudentController::class,'index']);
Route::get('students/{id}',[StudentController::class,'show']);
Route::post('students',[StudentController::class,'store']);
Route::put('students/{id}',[StudentController::class,'update']);
Route::delete('students/{id}',[StudentController::class,'destroy']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

//protected Routes
Route::middleware('auth:sanctum')->post('students',[StudentController::class,'store']);
Route::middleware('auth:sanctum')->put('students/{id}',[StudentController::class,'update']);
Route::middleware('auth:sanctum')->delete('students/{id}',[StudentController::class,'delete']);

Route::middleware('auth:sanctum')->post('logout',[UserController::class,'logout']);