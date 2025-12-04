<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ModulSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(WorkTimeSeeder::class);
    }
}
