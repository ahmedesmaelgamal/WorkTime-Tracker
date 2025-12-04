<?php

namespace App\Services\Admin;


use App\Models\Employee;
use App\Models\Project;
use App\Models\Modul;
use App\Models\WorkTime;

class WorkTimeService
{

    public function __construct(
        protected WorkTime $workTimes,

    ) {
    }

    public function index()
    {

        $monthlyWorkTimes = $this->workTimes->selectRaw('MONTH(created_at) as months, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('months')
            ->pluck('count', 'months');

        $workTimesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $workTimesData[] = $monthlyWorkTimes[$i] ?? 0;
        }
        return view('admin.work_times.index', [
            "workTimesData" => $workTimesData,
        ]);
    }


}