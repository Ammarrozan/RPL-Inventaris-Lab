<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'id' => 1,
                'nama' => 'routerr',
                'deskripsi' => 'praktek',
                'stok_total' => 20,
                'stok_tersedia' => 6,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 5',
            ],
            [
                'id' => 2,
                'nama' => 'lan',
                'deskripsi' => 'praktel',
                'stok_total' => 15,
                'stok_tersedia' => 4,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 6',
            ],
            [
                'id' => 3,
                'nama' => 'converter',
                'deskripsi' => 'praktek',
                'stok_total' => 14,
                'stok_tersedia' => 6,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 10',
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}