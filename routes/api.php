<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AdminAuthController::class, 'login']);
    
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::get('/user', [AdminAuthController::class, 'user']);
    
    Route::post('/report-data', [DashboardController::class, 'getReportData']);
});