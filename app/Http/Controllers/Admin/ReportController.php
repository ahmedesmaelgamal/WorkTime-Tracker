<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {
    }

    public function filter(Request $request)
    {
        return response()->json([
            "success" => true,
            "data" => $this->reportService->filter($request)
        ]);
    }
}
