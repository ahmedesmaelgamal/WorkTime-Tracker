<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use App\Services\Admin\ModulService;
class ModulController extends Controller
{
    public function __construct(
        protected ModulService $modulService
    ) {
    }
    public function index(Request $request)
    {
        return response()->json($this->modulService->index($request));
    }

    // public function create()
    // {
    //     return $this->modulService->create();
    // }

    // public function store(Request $request)
    // {
    //     // Validation logic here
    //     // Modul::create($request->all());
    //     return redirect()->route('moduls.index');
    // }

    // public function show(Modul $modul)
    // {
    //     return view('admin.moduls.show', compact('modul'));
    // }

    // public function edit(Modul $modul)
    // {
    //     return view('admin.moduls.edit', compact('modul'));
    // }

    // public function update(Request $request, Modul $modul)
    // {
    //     // Validation logic here
    //     // $modul->update($request->all());
    //     return redirect()->route('moduls.index');
    // }

    // public function destroy(Modul $modul)
    // {
    //     $modul->delete();
    //     return redirect()->route('moduls.index');
    // }
}
