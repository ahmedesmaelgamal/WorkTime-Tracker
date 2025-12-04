<?php   

namespace App\Services\Admin;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulService
{
    public function __construct(
    ) {
    }
    public function index(){
        $moduls = Modul::all();
        return response()->json([
            "success" => true,
            "data" => $moduls
        ]);
    }
    public function getTableView()
    {
        $moduls = Modul::all();
        return view('admin.moduls.index', compact('moduls'))->render();
    }
    public function getAllModuls(){
        $moduls = Modul::all();
        return $moduls;
    }
    
}