<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AdminAuthController::class, 'login']);
    
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::get('/user', [AdminAuthController::class, 'user']);
    
    // Report data
    Route::post('/report-data', [DashboardController::class, 'getReportData']);
});