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
            'value' => 'read',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'write',
            'type' => 'user',
        ]);
        Permissions::create([
            'id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'view',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'create',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'delete',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_updatable',
            'type' => 'document'
        ]);
        Permissions::create([
            'id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_public',
            'type' => 'document'
        ]);
        Permissions::create([
            'id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_deletable',
            'type' => 'document'
        ]);
        Permissions::create([
            'id' => 9,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'is_viewable',
            'type' => 'document'
        ]);
        Permissions::create([
            'id' => 10,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'update',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 11,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'viewAny',
            'type' => 'user'
        ]);
        Permissions::create([
            'id' => 12,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'create',
            'type' => 'document'
        ]);
        Permissions::create([
            'id' => 13,
            'created_at' => now(),
            'updated_at' => now(),
            'value' => 'viewAny',
            'type' => 'document'
        ]);
    }
}
