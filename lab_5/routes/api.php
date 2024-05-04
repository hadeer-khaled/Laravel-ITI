<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController ;
use App\Http\Controllers\API\PostController ;


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

Route::get("/hi", function (Request $request) {
    return "Hi";
});
Route::get("/users",[UserController::class,'index'] )->name('user.index');
Route::get("/posts",[PostController::class,'index'] )->name('post.index');
Route::post("/posts",[PostController::class,'store'] )->name('post.store');

// Route::apiResource("/users",UserControllerApi::class);