<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user/')->group(function () {

    Route::prefix('transactions/')->group(function () {
        Route::get('list', [TransactionController::class, 'index']);
        Route::post('store', [TransactionController::class, 'store']);
        Route::get('details/{id}', [TransactionController::class, 'show']);
    });

})->middleware('auth:sanctum');
