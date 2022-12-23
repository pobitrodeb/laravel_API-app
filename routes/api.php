<?php

use App\Http\Controllers\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get api for feach usesr
Route::get('/users/{id?}', [UserApiController::class, 'showUser']);

//post api for add user
Route::post('/add-user', [UserApiController::class, 'addUser']);

// post api for multple user
Route::post('/add-multi-user', [UserApiController::class, 'addMultiUser']);

//put api for add update user details
Route::put('/update-user-details/{id}', [UserApiController::class, 'updateUser']);
