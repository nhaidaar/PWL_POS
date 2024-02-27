<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'EL001',
                'barang_nama' => 'Laptop 1',
                'harga_beli' => 8000000,
                'harga_jual' => 10000000,
            ],
            [
                'kategori_id' => 1,
                'barang_kode' => 'EL002',
                'barang_nama' => 'Laptop 2',
                'harga_beli' => 9000000,
                'harga_jual' => 11000000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'CL001',
                'barang_nama' => 'T-Shirt 1',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            [
                'kategori_id' => 2,
                'barang_kode' => 'CL002',
                'barang_nama' => 'T-Shirt 2',
                'harga_beli' => 60000,
                'harga_jual' => 85000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'BK001',
                'barang_nama' => 'Book - Example 1',
                'harga_beli' => 250000,
                'harga_jual' => 300000,
            ],
            [
                'kategori_id' => 3,
                'barang_kode' => 'BK002',
                'barang_nama' => 'Book - Example 2',
                'harga_beli' => 350000,
                'harga_jual' => 400000,
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'TY001',
                'barang_nama' => 'Toys 1',
                'harga_beli' => 30000,
                'harga_jual' => 40000,
            ],
            [
                'kategori_id' => 4,
                'barang_kode' => 'TY002',
                'barang_nama' => 'Toys 2',
                'harga_beli' => 50000,
                'harga_jual' => 60000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'HC001',
                'barang_nama' => 'Homecare 1',
                'harga_beli' => 75000,
                'harga_jual' => 90000,
            ],
            [
                'kategori_id' => 5,
                'barang_kode' => 'HC002',
                'barang_nama' => 'Homecare 2',
                'harga_beli' => 85000,
                'harga_jual' => 100000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
