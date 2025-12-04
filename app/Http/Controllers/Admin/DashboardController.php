<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Modul;
use App\Models\WorkTime;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $stats = [
            'total_employees' => Employee::count(),
            'total_projects' => Project::count(),
            'total_moduls' => Modul::count(),
            'total_hours' => WorkTime::sum('hours'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function getReportData(Request $request)
    {
        $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'project_id' => 'nullable|exists:projects,id',
            'modul_id' => 'nullable|exists:moduls,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = WorkTime::with(['employee', 'project', 'modul']);

        if ($request->employee_id) {
            $query->where('emp_id', $request->employee_id);
        }

        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->modul_id) {
            $query->where('modul_id', $request->modul_id);
        }

        if ($request->start_date) {
            $query->where('date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->where('date', '<=', $request->end_date);
        }

        $data = $query->orderBy('date', 'desc')->paginate(10);

        // Calculate totals
        $totalHours = $query->sum('hours');
        $totalCost = 0;

        foreach ($data as $workTime) {
            $hourlyRate = $workTime->employee->salary / 160;
            $totalCost += $workTime->hours * $hourlyRate;
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'totals' => [
                'hours' => $totalHours,
                'cost' => round($totalCost, 2),
            ],
            'filters' => [
                'employee' => $request->employee_id,
                'project' => $request->project_id,
                'modul' => $request->modul_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]
        ]);
    }
}
