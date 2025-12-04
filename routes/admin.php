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

Route::resource('employees', EmployeeController::class);
Route::resource('projects', ProjectController::class);
Route::resource('moduls', ModulController::class);
Route::resource('work-times', WorkTimeController::class);

Route::get('/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
Route::post('/report/filter', [ReportController::class, 'filter'])->name('report.filter');