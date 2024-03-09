<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('change-password', [AuthController::class, 'changePassword']);

        Route::post('verify-otp', [AuthController::class, 'forgotOTPVerify']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
    });

    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
});