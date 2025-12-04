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
                    $html = $this->modulService->getTableView();
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
        $employees = $this->employeeService->getAllEmployees();
        $projects = $this->projectService->getAllProjects();
        $moduls = $this->modulService->getAllModuls();
        $workTimes = $this->workTimeService->getAllWorkTimes();
        
        // $stats = [
        //     'employees_count' => count($employees->toArray() ?? []),
        //     'projects_count' => count($projects->toArray() ?? []),
        //     'moduls_count' => count($moduls->toArray() ?? []),
        //     'total_hours' => round($workTimes->sum('hours'), 1),
        //     'total_cost' => '$' . number_format($workTimes->sum(function($wt) {
        //         $hourlyRate = $wt->employee->salary / 160;
        //         return $wt->hours * $hourlyRate;
        //     }), 2),
        // ];
        
        // $recentWorkTimes = $workTimes->take(10)->map(function($workTime) {
        //     return (object) [
        //         'formatted_date' => $workTime->date->format('M d, Y'),
        //         'employee_name' => $workTime->employee->name,
        //         'project_name' => $workTime->project->name,
        //         'hours' => $workTime->hours,
        //     ];
        // });
        
        // $topEmployees = $employees->map(function($employee) {
        //     $totalHours = $employee->workTimes->sum('hours');
        //     $hourlyRate = $employee->salary / 160;
        //     $totalCost = $totalHours * $hourlyRate;
            
        //     return (object) [
        //         'name' => $employee->name,
        //         'total_hours' => round($totalHours, 1),
        //         'total_cost' => '$' . number_format($totalCost, 2),
        //     ];
        // })->sortByDesc('total_hours')->take(5);
        
        // return view('admin.all', compact('stats', 'recentWorkTimes', 'topEmployees'))->render();
        return view('admin.all')->render();
    }
}
