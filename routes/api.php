<?php

use App\Http\Controllers\Api\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AdminAuthController::class, 'login']);
