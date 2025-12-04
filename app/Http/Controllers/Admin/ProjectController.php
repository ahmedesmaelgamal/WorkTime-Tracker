<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\Admin\ProjectService;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService) {}

    public function index()
    {
        return $this->projectService->index();
    }

    // public function create()
    // {
    //     return view('admin.projects.create');
    // }

    // public function store(Request $request)
    // {
    //     // Validation logic here
    //     // Project::create($request->all());
    //     return redirect()->route('projects.index');
    // }

    // public function show(Project $project)
    // {
    //     return view('admin.projects.show', compact('project'));
    // }

    // public function edit(Project $project)
    // {
    //     return view('admin.projects.edit', compact('project'));
    // }

    // public function update(Request $request, Project $project)
    // {
    //     // Validation logic here
    //     // $project->update($request->all());
    //     return redirect()->route('projects.index');
    // }

    // public function destroy(Project $project)
    // {
    //     $project->delete();
    //     return redirect()->route('projects.index');
    // }
}
