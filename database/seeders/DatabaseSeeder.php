<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Database\Seeders\UserSeeder;
=======
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolePermissionSeeder::class,
<<<<<<< HEAD
            UserSeeder::class,
=======
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a
        ]);
    }
}
