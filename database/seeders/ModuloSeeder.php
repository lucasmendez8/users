<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            [
                'nombre' => $nombre = 'Usuarios',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Roles',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Permisos',
                'slug' => Str::slug($nombre),
                'activo' => true
            ]
        ]);
    }
}
