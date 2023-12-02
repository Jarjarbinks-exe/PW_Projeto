<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'category1'
        ]);
        Category::create([
            'id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'category2'
        ]);
        Category::create([
            'id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'category3'
        ]);
    }
}
