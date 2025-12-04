<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ModulController;
use App\Http\Controllers\Admin\WorkTimeController;
use App\Http\Controllers\Admin\ReportController;
Route::get('/', function () {
    return view('admin.app');
});
Route::get('/template', function () {
    return view('template');
});

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
// Protected Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // AJAX endpoints for web
    Route::post('/report/filter', [DashboardController::class, 'getReportData']);
});



// Resource routes
Route::resource('employees', EmployeeController::class);
Route::resource('projects', ProjectController::class);
Route::resource('moduls', ModulController::class);
Route::resource('work-times', WorkTimeController::class);

// Additional custom routes
Route::get('/reports', [ReportController::class, 'index'])->name('reports');
// Route::get('/all', [ReportController::class, ''])->name('all');
Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
Route::post('/report/filter', [ReportController::class, 'filter'])->name('report.filter');