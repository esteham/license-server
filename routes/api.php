<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('throttle:50,1')->group(function () {
    Route::match(['get', 'post'], '/claim', [LicenseApiController::class, 'claim']);
    Route::match(['get', 'post'], '/verify', [LicenseApiController::class, 'verify']);
    
});
