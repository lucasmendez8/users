<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            [
                'nombre' => $nombre = 'Crear Permisos',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Editar Permisos',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Eliminar Permisos',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Listar Permisos',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Crear Roles',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Editar Roles',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Eliminar Roles',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Listar Roles',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Crear Usuario',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Editar Usuario',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Eliminar Usuario',
                'slug' => Str::slug($nombre),
                'activo' => true
            ], [
                'nombre' => $nombre = 'Listar Usuarios',
                'slug' => Str::slug($nombre),
                'activo' => true
            ]
        ]);
    }
}
