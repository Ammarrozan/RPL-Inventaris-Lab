<?php

namespace Database\Seeders;

use App\Models\StatusPeminjam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Dipinjam', 'Selesai', 'Terlambat','Menunggu Approval'];

        foreach ($status as $item){
            StatusPeminjam::create(['nama' => $item]);
        }
    }
}
