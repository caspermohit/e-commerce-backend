<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
  Route::get('/category', [CategoryController::class,'index']);
    Route::post('/category', [CategoryController::class,'store']);
    Route::get('/product', [ProductController::class,'index']);
    Route::post('/product', [ProductController::class,'store']);  

Route::middleware ('auth:sanctum')->group (function(){
      
    
});