<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ModuloSeeder::class,
            PermisoSeeder::class,
            RolSeeder::class,
            UserSeeder::class
        ]);
    }
}
