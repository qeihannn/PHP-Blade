<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Sarana'],
            ['nama_kategori' => 'Prasarana'],
            ['nama_kategori' => 'Lainnya'],
        ]);
    }
}
