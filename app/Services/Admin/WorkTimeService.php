<?php

namespace App\Services\Admin;


use App\Models\WorkTime;


class WorkTimeService
{
    public function index()
    {
        $workTimes = WorkTime::with(['employee', 'project', 'modul'])
            ->orderBy('date', 'desc')
            ->get();
        
        return response()->json([
            "success" => true,
            "data" => $workTimes
        ]);
    }
    
    public function getTableView()
    {
        $workTimes = WorkTime::with(['employee', 'project', 'modul'])
            ->orderBy('date', 'desc')
            ->limit(50)
            ->get();
        
        $workTimes = $workTimes->map(function ($workTime) {
            $hourlyRate = $workTime->employee->salary / 160;
            $cost = $workTime->hours * $hourlyRate;
            
            return (object) [
                'id' => $workTime->id,
                'date' => $workTime->date->format('Y-m-d'),
                'employee_name' => $workTime->employee->name,
                'project_name' => $workTime->project->name,
                'modul_name' => $workTime->modul->name,
                'hours' => $workTime->hours,
                'cost' => '$' . number_format($cost, 2),
            ];
        });
        
        return view('admin.work_times.index', compact('workTimes'))->render();
    }
    
    public function getAllWorkTimes()
    {
        $workTimes = WorkTime::with(['employee', 'project', 'modul'])
            ->orderBy('date', 'desc')
            ->get();
        return $workTimes;
    }
}