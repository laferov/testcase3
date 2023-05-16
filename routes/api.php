<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DriverActionController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\OrderController;

use App\Http\Controllers\TestController;

use App\Models\User;


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

Route::get('/user/{id?}', function($id){
    $user = User::find($id)->only('name');
    return $user;
});


#Route::match(['put','post'],'/test', [TestController::class, 'test']);

// Route::put('/test/{id}', function(Request $request,$id) {
//     die($id);

// });

Route::prefix('drivers')->group(function () {
    Route::get('/',[DriverController::class,'index']);
    Route::get('/status/{id}',[DriverController::class,'getDriverStatus']);
    Route::get('/active',[DriverController::class,'getActiveDrivers']);
    Route::get('/position/{id}',[DriverController::class,'getDriverPos']);
    Route::post('/position/{id}',[DriverController::class,'setDriverPos']);
});

Route::prefix('orders')->group(function () {
    Route::put('/create',[OrderController::class,'store']);
});



#Route::get('/test/{id?}', [DriverActionController::class,'checkstatus']);

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);

//     return ['token' => $token->plainTextToken];
// });