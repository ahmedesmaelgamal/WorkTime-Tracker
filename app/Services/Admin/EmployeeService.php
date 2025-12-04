<?php

namespace App\Services\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeService
{
     public function index()
    {
        $employees = Employee::get();
        return response()->json([
            "success" => true,
            "data" => $employees
        ]);
    }
    public function getTableView()
    {
        $employees = Employee::get();
        return view('admin.employees.index', compact('employees'))->render();
    }
    public function getAllEmployees()
    {
        $employees = Employee::get();
        return $employees;
    }

}