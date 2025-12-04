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

}
