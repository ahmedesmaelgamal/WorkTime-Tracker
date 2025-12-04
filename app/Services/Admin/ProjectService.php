<?php

namespace App\Services\Admin;

use App\Models\Project;

class ProjectService
{
     public function index()
    {
        $projects = Project::with('moduls')->get();
        return view('admin.projects.index', compact('projects'));
    }
}