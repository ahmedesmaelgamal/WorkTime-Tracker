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

    // public function create()
    // {
    //     return view('admin.employees.create');
    // }

    // public function store(Request $request)
    // {
    //     // Validation logic here
    //     // Employee::create($request->all());
    //     return redirect()->route('employees.index');
    // }

    // public function show(Employee $employee)
    // {
    //     return view('admin.employees.show', compact('employee'));
    // }

    // public function edit(Employee $employee)
    // {
    //     return view('admin.employees.edit', compact('employee'));
    // }

    // public function update(Request $request, Employee $employee)
    // {
    //     // Validation logic here
    //     // $employee->update($request->all());
    //     return redirect()->route('employees.index');
    // }

    // public function destroy(Employee $employee)
    // {
    //     $employee->delete();
    //     return redirect()->route('employees.index');
    // }
}