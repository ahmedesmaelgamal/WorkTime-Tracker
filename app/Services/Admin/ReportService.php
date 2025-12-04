<?php

namespace App\Services\Admin;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\Admin\EmployeeService;
use App\Services\Admin\ProjectService;
use App\Services\Admin\ModulService;
use App\Services\Admin\WorkTimeService;

class ReportService
{
    public function __construct(
        public EmployeeService $employerService,
        public ProjectService $projectService,
        public ModulService $modulService,
        public WorkTimeService $workTimeService
    ) {
    }
    //  public function index()
    // { 
    //     $employees = Employee::get();
    //     return response()->json([
    //         "success" => true,
    //         "data" => $employees
    //     ]);
    // }
    public function filter(Request $request){
        if($request->has('table_filter')){
            if($request->get('table_filter') == 'employees'){
                return $this->employerService->index();
            }else if($request->get('table_filter') == 'projects'){
                return $this->projectService->index();
            }else if($request->get('table_filter') == 'moduls'){
                return $this->modulService->index();
            }else if($request->get('table_filter') == 'work_times'){
                return $this->workTimeService->index();
            }
        }
    }
    
}