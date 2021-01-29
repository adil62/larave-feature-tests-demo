<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
 
Route::group([
    'prefix' => 'user',
], function() {
    Route::get('/', [UserController::class, 'index'] );
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/{userId}', [UserController::class, 'update']);
    Route::delete('/{userId}',[UserController::class, 'delete']);
});