<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkTime;
use Illuminate\Http\Request;

class WorkTimeController extends Controller
{
    public function index()
    {
        $workTimes = WorkTime::all();
        return view('admin.work_times.index', compact('workTimes'));
    }

    public function create()
    {
        return view('admin.work_times.create');
    }

    public function store(Request $request)
    {
        // Validation logic here
        // WorkTime::create($request->all());
        return redirect()->route('work-times.index');
    }

    public function show(WorkTime $workTime)
    {
        return view('admin.work_times.show', compact('workTime'));
    }

    public function edit(WorkTime $workTime)
    {
        return view('admin.work_times.edit', compact('workTime'));
    }

    public function update(Request $request, WorkTime $workTime)
    {
        // Validation logic here
        // $workTime->update($request->all());
        return redirect()->route('work-times.index');
    }

    public function destroy(WorkTime $workTime)
    {
        $workTime->delete();
        return redirect()->route('work-times.index');
    }
}
