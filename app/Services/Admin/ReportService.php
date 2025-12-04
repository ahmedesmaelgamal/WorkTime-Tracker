<?php

namespace App\Services\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;

class ReportService
{
     public function index()
    {
        $employees = Employee::all();
        return view('admin.reports.index', compact('employees'));
    }
}