<?php

namespace App\Services\Admin;


use App\Models\Employee;
use App\Models\Project;
use App\Models\Modul;
use App\Models\WorkTime;

class WorkTimeService
{

    public function __construct(
        protected Employee $employees,
        protected Project $projects,
        protected Modul $modules,
        protected WorkTime $workTimes,

    ) {
    }

    public function index()
    {

        $monthlyEmployees = $this->employees->selectRaw('MONTH(created_at) as months, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->pluck('count', 'months');

        $employeesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $employeesData[] = $monthlyEmployees[$i] ?? 0;
        }


        $monthlyProjects = $this->projects->selectRaw('MONTH(created_at) as months, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->pluck('count', 'months');

        $projectsData = [];
        for ($i = 1; $i <= 12; $i++) {
            $projectsData[] = $monthlyProjects[$i] ?? 0;
        }

        $monthlyModules = $this->modules->selectRaw('MONTH(created_at) as months, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->pluck('count', 'months');

        $modulesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $modulesData[] = $monthlyModules[$i] ?? 0;
        }

        $monthlyWorkTimes = $this->workTimes->selectRaw('MONTH(created_at) as months, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->pluck('count', 'months');

        $workTimesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $workTimesData[] = $monthlyWorkTimes[$i] ?? 0;
        }


    

        // Calculate user change percentage
        $currentUsers = $this->employees->count();
        $previousUsers = $this->employees->where('created_at', '<', now()->subDay())->count();
        $userChange = $previousUsers ? (($currentUsers - $previousUsers) / $previousUsers * 100) : 0;


        // Calculate change percentage for Associations
        $currentAssociations = $this->projects->count();
        $previousAssociations = $this->projects->where('created_at', '<', now()->subDay())->count();
        $associationChange = $previousAssociations ? (($currentAssociations - $previousAssociations) / $previousAssociations * 100) : 0;

        // Calculate change percentage for RealStates
        $currentRealStates = $this->modules->count();
        $previousRealStates = $this->modules->where('created_at', '<', now()->subDay())->count();
        $realStateChange = $previousRealStates ? (($currentRealStates - $previousRealStates) / $previousRealStates * 100) : 0;

        // Calculate change percentage for Units
        $currentUnits = $this->workTimes->count();
        $previousUnits = $this->workTimes->where('created_at', '<', now()->subDay())->count();
        $unitChange = $previousUnits ? (($currentUnits - $previousUnits) / $previousUnits * 100) : 0;

        return view('admin.index', [
            "employees" => $currentUsers,
            "projects" => $currentAssociations,
            "modules" => $currentRealStates,
            "workTimes" => $currentUnits,
            "employeesData" => $employeesData,
            "projectsData" => $projectsData,
            "modulesData" => $modulesData,
            "workTimesData" => $workTimesData,
                "employeesChange" => number_format($userChange,1),
            "projectsChange" => number_format($associationChange,1),
            "modulesChange" => number_format($realStateChange,1),
            "workTimesChange" => number_format($unitChange,1),
        ]);
    }


}