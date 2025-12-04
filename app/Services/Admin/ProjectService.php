<?php

namespace App\Services\Admin;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectService
{
     public function index()
    {
        $projects = Project::with('moduls')->get();
        return response()->json([
            "success" => true,
            "data" => $projects
        ]);
    }
    public function getTableView()
    {
        $projects = Project::with('moduls')->get();
        return view('admin.projects.index', compact('projects'))->render();
    }
    public function getAllProjects(){
        $projects = Project::with('moduls')->get();
        return $projects;
    }
}