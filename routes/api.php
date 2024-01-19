<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', LoginController::class)->name('login');

Route::middleware(['auth:api'])->group(function () {

    Route::post('/logout', LogoutController::class);

    Route::middleware(['role:ADMIN'])->group(function () {
        Route::apiResource('/user', UserController::class);
    });

    Route::middleware(['role:USER'])->group(function () {
        Route::get('/users', [UserController::class, 'index']);
    });
});