<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function export()
    {
        // Export logic here
        return redirect()->back()->with('success', 'Report exported successfully.');
    }
}
