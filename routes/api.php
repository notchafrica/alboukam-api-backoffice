<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
