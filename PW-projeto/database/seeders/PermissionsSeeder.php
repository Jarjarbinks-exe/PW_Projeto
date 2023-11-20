<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permissions::create([
            'id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'read'
        ]);
        Permissions::create([
            'id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'write'
        ]);
        Permissions::create([
            'id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'view'
        ]);
        Permissions::create([
            'id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'create'
        ]);
        Permissions::create([
            'id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'delete'
        ]);
        Permissions::create([
            'id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_editable'
        ]);
        Permissions::create([
            'id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_public'
        ]);
        Permissions::create([
            'id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_deletable'
        ]);
    }
}
