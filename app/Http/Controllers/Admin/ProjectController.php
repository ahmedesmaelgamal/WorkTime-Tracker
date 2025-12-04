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

    // public function index()
    // {
    //     return $this->projectService->index();
    // }



}
