<?php

namespace App\Services\Admin;


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
        return response()->json([
            "success" => true,
            "data" => $workTimesData
        ]);
    }

    public function getTableView()
    {
        $workTimes = WorkTime::all();
        return view('admin.projects.index', compact('stats', 'recentWorkTimes', 'topEmployees'))->render();
    }
    public function getAllWorkTimes(){
        $workTimes = WorkTime::all();
        return $workTimes;
    }
}