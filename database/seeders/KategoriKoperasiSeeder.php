<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKoperasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_cooperatives')->insert([[
            'nama' => 'Simpan Pinjam',
            'deskripsi' => 'seeder',
            'slug' => 'simpan-pinjam',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'nama' => 'Waserda/Konsumsi/Warung',
            'deskripsi' => 'seeder',
            'slug' => 'waserda-konsumsi-warung',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'nama' => 'Produksi',
            'deskripsi' => 'seeder',
            'slug' => 'produksi',
            'created_at' => now(),
            'updated_at' => now(),
        ]]);
    }
}
