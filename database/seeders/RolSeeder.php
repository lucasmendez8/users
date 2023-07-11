<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'descripcion' => $descripcion = 'Super Admin',
                'abreviatura' => 'Super Admin',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Contacto',
                'abreviatura' => 'Contacto',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Cliente',
                'abreviatura' => 'Cliente',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Proveedor',
                'abreviatura' => 'Proveedor',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Vendedor',
                'abreviatura' => 'Vendedor',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Cobrador',
                'abreviatura' => 'Cobrador',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Representación',
                'abreviatura' => 'Representación',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ], [
                'descripcion' => $descripcion = 'Afiliado',
                'abreviatura' => 'Afiliado',
                'slug' => Str::slug($descripcion),
                'activo' => true,
            ]
        ]);
    }
}
