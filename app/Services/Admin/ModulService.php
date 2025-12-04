<?php   

namespace App\Services\Admin;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulService
{
    public function index()
    {
        $moduls = Modul::with('workTimes.employee')->get();
        return response()->json([
            "success" => true,
            "data" => $moduls
        ]);
    }

      public function getTableView()
    {
        try {
            $moduls = Modul::with('workTimes.employee')->get();
            
            if ($moduls->isEmpty()) {
                return '<div class="col-12"><div class="alert alert-info">No module data available</div></div>';
            }
            
            $formattedModuls = $moduls->map(function ($modul) {
                $workTimes = $modul->workTimes;
                $totalHours = $workTimes->sum('hours') ?? 0;
                $totalCost = 0;
                
                foreach ($workTimes as $workTime) {
                    if ($workTime->employee) {
                        $hourlyRate = $workTime->employee->salary / 160;
                        $totalCost += $workTime->hours * $hourlyRate;
                    }
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
            
            return view('admin.moduls.index', ['moduls' => $formattedModuls])->render();
            
        } catch (\Exception $e) {
            logger('Error in ModulService::getTableView: ' . $e->getMessage());
            return '<div class="col-12"><div class="alert alert-danger">Error loading module data: ' . $e->getMessage() . '</div></div>';
        }
    }
    
    public function getAllModuls()
    {
        $moduls = Modul::with('workTimes.employee')->get();
        return $moduls;
    }
}