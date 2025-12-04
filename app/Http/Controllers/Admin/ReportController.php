<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ReportService;
use App\Services\Admin\EmployeeService;
use App\Services\Admin\ProjectService;
use App\Services\Admin\ModulService;
use App\Services\Admin\WorkTimeService;

class ReportController extends Controller
{
    protected $reportService;
    protected $employeeService;
    protected $projectService;
    protected $modulService;
    protected $workTimeService;
    
    public function __construct(
        ReportService $reportService,
        EmployeeService $employeeService,
        ProjectService $projectService,
        ModulService $modulService,
        WorkTimeService $workTimeService
    ) {
        // $this->middleware('auth:admin');
        $this->reportService = $reportService;
        $this->employeeService = $employeeService;
        $this->projectService = $projectService;
        $this->modulService = $modulService;
        $this->workTimeService = $workTimeService;
    }
    
    public function filter(Request $request)
    {
        if ($request->has('table_filter')) {
            switch ($request->get('table_filter')) {
                case 'employees':
                    $html = $this->employeeService->getTableView();
                    break;
                    
                case 'projects':
                    $html = $this->projectService->getTableView();
                    break;
                    
                case 'moduls':
                    // Debug: Check if service is working
                    logger('Loading moduls table view');
                    $html = $this->modulService->getTableView();
                    logger('HTML length: ' . strlen($html));
                    break;
                    
                case 'work_times':
                    $html = $this->workTimeService->getTableView();
                    break;
                    
                case 'all':
                    $html = $this->getAllTableView();
                    break;
                    
                default:
                    $html = '<div class="col-12"><div class="alert alert-info">Please select a valid table</div></div>';
            }
            
            return response()->json([
                "success" => true,
                "html" => $html
            ]);
        }
        
        return response()->json([
            "success" => false,
            "message" => "No table filter specified"
        ]);
    }



    private function getAllTableView()
    {
        // Get data from services
        $employees = $this->employeeService->getAllEmployees();
        $projects = $this->projectService->getAllProjects();
        $moduls = $this->modulService->getAllModuls();
        $workTimes = $this->workTimeService->getAllWorkTimes();
        
        // Format the data for views
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
                'total_project_cost' => '$' . number_format($totalCost, 2),
            ];
        });
        
        $moduls = $moduls->map(function ($modul) {
            $workTimes = $modul->workTimes;
            $totalHours = $workTimes->sum('hours');
            $totalCost = 0;
            
            foreach ($workTimes as $workTime) {
                $hourlyRate = $workTime->employee->salary / 160;
                $totalCost += $workTime->hours * $hourlyRate;
            }
            
            $projectIds = $workTimes->pluck('project_id')->unique()->count();
            
            return (object) [
                'id' => $modul->id,
                'name' => $modul->name,
                'total_hours' => round($totalHours, 1),
                'total_cost' => '$' . number_format($totalCost, 2),
                'total_projects' => $projectIds,
            ];
        });
        
        $workTimes = $workTimes->take(20)->map(function ($workTime) {
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
        
        return view('admin.all', compact('employees', 'projects', 'moduls', 'workTimes'))->render();
    }
}
