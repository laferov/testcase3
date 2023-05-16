<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverActionController;

use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index',['content' => 'Lorem Ipsum']);
});

Route::post('drivers/changepos/{id}',[DriverActionController::class,'setpos'])->name('changeDriverPos');

Route::get('/drivers/active',['App\Http\Controllers\Api\DriverController','getActiveDrivers']);

Route::get('/test/{var?}', [TestController::class,'index'])->name('testroute');

Route::get('/map', function () {
    return view('map');
});

Route::get('manage/drivers/changestatus/{id?}', [DriverActionController::class,'changestatus'])->middleware('auth')->name('changeStatus');

Route::resource('manage/drivers', DriverController::class)->middleware('auth');



Route::resource('orders', OrderController::class)->middleware('auth');


// Route::get('/manage', function (Request $request) {
//         echo $request->getHttpHost();
//     })->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
