<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $penjualan_id = 1;

        // Generate 30 Detail Transaksi
        for ($i = 1; $i <= 30; $i++) {
            $barang_id = rand(1, 10); // Random barang_id between 1 and 10
            $harga = 10000 + (rand(0, 18) * 5000); // Random harga 10000 - 100000
            $jumlah = rand(1, 10);

            // Tambahkan data ke array
            $data[] = [
                'penjualan_id' => $penjualan_id,
                'barang_id' => $barang_id,
                'harga' => $harga,
                'jumlah' => $jumlah,
            ];

            // Setiap 3 barang, akan berganti id penjualan
            if ($i % 3 == 0) {
                $penjualan_id++;
            }
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}
