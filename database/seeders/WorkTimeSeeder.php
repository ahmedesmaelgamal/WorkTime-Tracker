<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkTime;

class WorkTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $workTimes = [
            ['date' => '2025-10-05', 'hours' => 2, 'emp_id' => 3, 'project_id' => 2, 'modul_id' => 1],
            ['date' => '2025-10-05', 'hours' => 3, 'emp_id' => 3, 'project_id' => 3, 'modul_id' => 4],
        ];

        foreach ($workTimes as $workTime) {
            WorkTime::create($workTime);
        }
    }
}
