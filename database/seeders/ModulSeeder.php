<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modul;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $moduls = [
            ['name' => 'analysis'],
            ['name' => 'Design'],
            ['name' => 'Development'],
            ['name' => 'Testing'],
        ];

        foreach ($moduls as $modul) {
            Modul::create($modul);
        }
    }
}
