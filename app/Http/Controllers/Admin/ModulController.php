<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        $moduls = Modul::all();
        return view('admin.moduls.index', compact('moduls'));
    }

    public function create()
    {
        return view('admin.moduls.create');
    }

    public function store(Request $request)
    {
        // Validation logic here
        // Modul::create($request->all());
        return redirect()->route('moduls.index');
    }

    public function show(Modul $modul)
    {
        return view('admin.moduls.show', compact('modul'));
    }

    public function edit(Modul $modul)
    {
        return view('admin.moduls.edit', compact('modul'));
    }

    public function update(Request $request, Modul $modul)
    {
        // Validation logic here
        // $modul->update($request->all());
        return redirect()->route('moduls.index');
    }

    public function destroy(Modul $modul)
    {
        $modul->delete();
        return redirect()->route('moduls.index');
    }
}
