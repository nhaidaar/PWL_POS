<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_kode' => '1',
                'kategori_nama' => 'Electronics',
            ],
            [
                'kategori_kode' => '2',
                'kategori_nama' => 'Clothing',
            ],
            [
                'kategori_kode' => '3',
                'kategori_nama' => 'Books',
            ],
            [
                'kategori_kode' => '4',
                'kategori_nama' => 'Toys',
            ],
            [
                'kategori_kode' => '5',
                'kategori_nama' => 'Homecare',
            ],

        ];

        DB::table('m_kategori')->insert($data);
    }
}
