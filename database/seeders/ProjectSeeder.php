<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $projects = [
            ['name' => 'web site'],
            ['name' => 'deleivry app '],
            ['name' => 'erp system '],
            ['name' => 'shiping app '],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
