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
                'nombre_corto' => 'crear',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 3
            ], [
                'nombre' => $nombre = 'Editar Permisos',
                'nombre_corto' => 'editar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 3
            ], [
                'nombre' => $nombre = 'Eliminar Permisos',
                'nombre_corto' => 'eliminar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 3
            ], [
                'nombre' => $nombre = 'Listar Permisos',
                'nombre_corto' => 'listar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 3
            ], [
                'nombre' => $nombre = 'Crear Roles',
                'slug' => Str::slug($nombre),
                'nombre_corto' => 'crear',
                'activo' => true,
                'modulo_id' => 2
            ], [
                'nombre' => $nombre = 'Editar Roles',
                'slug' => Str::slug($nombre),
                'nombre_corto' => 'editar',
                'activo' => true,
                'modulo_id' => 2
            ], [
                'nombre' => $nombre = 'Eliminar Roles',
                'nombre_corto' => 'eliminar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 2
            ], [
                'nombre' => $nombre = 'Listar Roles',
                'nombre_corto' => 'listar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 2
            ], [
                'nombre' => $nombre = 'Crear Usuario',
                'nombre_corto' => 'crear',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 1
            ], [
                'nombre' => $nombre = 'Editar Usuario',
                'nombre_corto' => 'editar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 1
            ], [
                'nombre' => $nombre = 'Eliminar Usuario',
                'nombre_corto' => 'eliminar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 1
            ], [
                'nombre' => $nombre = 'Listar Usuarios',
                'nombre_corto' => 'listar',
                'slug' => Str::slug($nombre),
                'activo' => true,
                'modulo_id' => 1
            ]
        ]);
    }
}
