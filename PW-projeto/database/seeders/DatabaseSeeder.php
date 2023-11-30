<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Document;
use App\Models\Permissions;
use App\Models\User;
use Database\Factories\Document_has_permissionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        //\App\Models\User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        //$this->call(AdministratorSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(MetadataSeeder::class);
        if (App::environment() == 'local') {
            User::factory(200)->create();
            Document::factory(20)->create();
            //Document::factory()->afterCreating(function ($document) {
            //    $document->permissions()->attach(
            //        Permissions::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray()
            //    );
            //});

        }

    }
}
