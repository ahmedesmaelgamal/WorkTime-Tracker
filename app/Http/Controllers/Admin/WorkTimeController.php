<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkTime;

class WorkTimeController extends Controller
{
    public function index()
    {
        $workTimes = WorkTime::all();
        return view('admin.work_times.index', compact('workTimes'));
    }
}
