<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectService
{
    public function index()
    {
        $projects = Project::with('workTimes.employee')->get();
        return response()->json([
            "success" => true,
            "data" => $projects
        ]);
    }
    
    public function getTableView()
    {
        $projects = Project::with('workTimes.employee')->get();
        $projects = $projects->map(function ($project) {
            $workTimes = $project->workTimes;
            $totalHours = $workTimes->sum('hours');
            $totalCost = 0;
            $employeeIds = [];
            
            foreach ($workTimes as $workTime) {
                $hourlyRate = $workTime->employee->salary / 160;
                $totalCost += $workTime->hours * $hourlyRate;
                $employeeIds[] = $workTime->emp_id;
            }
            
            $uniqueEmployees = count(array_unique($employeeIds));
            $uniqueDates = $workTimes->groupBy('date')->count();
            $startDate = $workTimes->min('date');
            $endDate = $workTimes->max('date');
            
            return (object) [
                'id' => $project->id,
                'name' => $project->name,
                'start_date' => $startDate ? $startDate->format('Y-m-d') : 'N/A',
                'end_date' => $endDate ? $endDate->format('Y-m-d') : 'N/A',
                'total_days' => $uniqueDates,
                'total_hours' => round($totalHours, 1),
                'total_employees' => $uniqueEmployees,
                'total_project_cost' =>  number_format($totalCost, 2),
            ];
        });
        
        return view('admin.projects.index', compact('projects'))->render();
    }
    
    public function getAllProjects()
    {
        $projects = Project::with('workTimes.employee')->get();
        return $projects;
    }
}