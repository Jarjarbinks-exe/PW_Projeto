<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Contabilidade'
        ]);
        Department::create([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Marketing'
        ]);
        Department::create([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Desenvolvimento'
        ]);
    }
}
