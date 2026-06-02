<?php

namespace Database\Seeders;

use App\Models\StatusMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = ['Aktif', 'Nonaktif', 'Blacklist'];

        foreach ($status as $item){
            StatusMahasiswa::create(['nama' => $item]);
        }
    }
}
