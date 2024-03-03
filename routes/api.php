<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () 
{
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('getTodoList', [App\Http\Controllers\TodoController::class, 'getTodoList']);
        Route::post('addTodo', [App\Http\Controllers\TodoController::class, 'addTodo']);
        Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
        Route::put('update', [App\Http\Controllers\TodoController::class, 'update']);
        Route::delete('delete', [App\Http\Controllers\TodoController::class, 'delete']);
    });
 
});
