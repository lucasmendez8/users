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
            'nombre' => 'codeco',
            'apellido' => 'codeco',
            'username' => 'codeco',
            'email' => 'codeco@admin.com',
            'password' => Hash::make('admin'),
            'primer_login' => false,
            'super_admin' => true
        ]);
    }
}
