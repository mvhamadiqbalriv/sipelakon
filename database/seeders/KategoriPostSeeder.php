<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_posts')->insert([[
            'nama' => 'Permodalan',
            'slug' => 'permodalan',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'nama' => 'Pemasaran',
            'slug' => 'pemasaran',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'nama' => 'Usaha',
            'slug' => 'usaha',
            'created_at' => now(),
            'updated_at' => now(),
        ]]);
    }
}
