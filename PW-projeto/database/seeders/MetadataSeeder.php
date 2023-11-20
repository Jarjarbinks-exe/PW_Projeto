<?php

namespace Database\Seeders;

use App\Models\Metadata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetadataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Metadata::create([
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'metadado1'
        ]);
        Metadata::create([
            'id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'metadado2'
        ]);
        Metadata::create([
            'id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'metadado3'
        ]);
    }
}
