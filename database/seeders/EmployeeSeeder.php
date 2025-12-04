<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employees = [
            ['name' => 'ahmed ali', 'salary' => 10000],
            ['name' => 'samy ibrahim', 'salary' => 12000],
            ['name' => 'adel ibrahem', 'salary' => 11000],
            ['name' => 'tamer mahnoud', 'salary' => 9000],
            ['name' => 'radwan ahmed', 'salary' => 7000],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
