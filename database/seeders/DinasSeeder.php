<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'dinas',
            'nik' => '666',
            'alamat' => 'sumedang',
            'username' => 'dinas',
            'email' => 'dinas@sipelakon.sumedangkab.go.id',
            'jenis_akun' => 'dinas',
            'password' => Hash::make('password'),
        ]);
    }
}
