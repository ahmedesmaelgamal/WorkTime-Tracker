<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\Admin\ProjectService;
class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService) {}




}
