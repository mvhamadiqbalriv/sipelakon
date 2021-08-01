<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'nik' => '666',
            'alamat' => 'sumedang',
            'username' => 'admin',
            'email' => 'admin@sipelakon.sumedangkab.go.id',
            'jenis_akun' => 'admin',
            'is_verified' => '1',
            'password' => Hash::make('password'),
        ]);
    }
}
