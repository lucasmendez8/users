<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'os',
            'apellido' => 'group',
            'username' => 'osgroup',
            'email' => 'osgroup@admin.com',
            'password' => Hash::make('admin'),
            'rol_id' => 1
        ]);
    }
}
