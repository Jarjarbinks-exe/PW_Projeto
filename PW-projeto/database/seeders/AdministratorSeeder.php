<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrator::create([
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
    }
}
