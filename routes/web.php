<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;



Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::prefix('api/v1')->group(function (){
    Route::prefix('auth')->group(function (){
        Route::post('register', [Auth\RegisterController::class, 'store']);
        Route::post('login', [Auth\AuthenticatedSessionController::class, 'store']);

        Route::middleware('auth')->group(function(){
            Route::post('logout', [Auth\AuthenticatedSessionController::class, 'destroy']);
        });
        
        
    });
});

require __DIR__.'/auth.php';
