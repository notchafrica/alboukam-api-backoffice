<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// guest
Route::group(['middleware' => ['guest:sanctum'], 'namespace' => 'Auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('login/deliver', [LoginController::class, 'deliverLogin']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('register/deliver', [RegisterController::class, 'deliverRegister']);
});

Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'Auth'], function () {
    Route::post('parcels', [ParcelController::class, 'store']);
    Route::post('parcels/{parcel:uid}/checkout', [ParcelController::class, 'checkout']);
    Route::put('parcels/{parcel:uid}/take', [ParcelController::class, 'take']);
    Route::put('parcels/{parcel:uid}/pickup', [ParcelController::class, 'pickUp']);
    Route::put('parcels/{parcel:uid}/delivered', [ParcelController::class, 'markAsDelivered']);
    Route::get('parcels', [ParcelController::class, 'index']);
    Route::get('parcels/all', [ParcelController::class, 'public'])->middleware('auth.deliver');

    Route::post('user', [ProfileController::class, 'update']);
    Route::post('user/password', [ProfileController::class, 'password']);
});
