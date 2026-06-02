<?php

namespace Database\Seeders;

use App\Models\KondisiBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kondisi = ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Tidak Layak'];

        foreach ($kondisi as $item) {
            KondisiBarang::create(['nama'=> $item]);
        }
    }
}
