<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Data Table: roles
        DB::table('roles')->insert([
            ['id' => 1, 'nama' => 'operator'],
            ['id' => 2, 'nama' => 'aslab'],
            ['id' => 3, 'nama' => 'kalab'],
            ['id' => 4, 'nama' => 'mahasiswa'],
        ]);

        // 2. Data Table: kondisi_barang
        DB::table('kondisi_barang')->insert([
            ['id' => 1, 'nama' => 'Baik'],
            ['id' => 2, 'nama' => 'Rusak Ringan'],
            ['id' => 3, 'nama' => 'Rusak Berat'],
            ['id' => 4, 'nama' => 'Tidak Layak'],
        ]);

        // 3. Data Table: status_mahasiswa
        DB::table('status_mahasiswa')->insert([
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Nonaktif'],
            ['id' => 3, 'nama' => 'Blacklist'],
        ]);

        // 4. Data Table: status_peminjam
        DB::table('status_peminjam')->insert([
            ['id' => 1, 'nama' => 'Dipinjam'],
            ['id' => 2, 'nama' => 'Selesai'],
            ['id' => 3, 'nama' => 'Terlambat'],
            ['id' => 4, 'nama' => 'Menunggu Approval'],
        ]);

        // 5. Data Table: users
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'radit',
                'email' => 'radit@gmail.com',
                'password' => '$2y$12$qI.hh52uPVqs3M9roKF5BOOoJXIz8.Ge/1H4nXkf/hsOBgawZ8uKe',
                'no_hp' => '-',
                'id_role' => 4,
            ],
            [
                'id' => 2,
                'name' => 'aslabbaru',
                'email' => 'baru@gmail.com',
                'password' => '$2y$12$8JZHWGRnw/xmyfsR0VLgqeZhzRIDf21vsMmVwiODpZ1kL08QsKRhC',
                'no_hp' => '-',
                'id_role' => 2,
            ],
            [
                'id' => 3,
                'name' => 'kuyy',
                'email' => 'kuy@gmail.com',
                'password' => '$2y$12$p5dOx3zAQ4P5gQWH.gx02.mmnSKp.IGLMHNAXmkqtshukMYqzcUnG',
                'no_hp' => '-',
                'id_role' => 2,
            ],
            [
                'id' => 4,
                'name' => 'yanto',
                'email' => 'yanto@mail.com',
                'password' => '$2y$12$RM9aF4AVVUsO4WAMy55S1uFetxnsGJH0HIdQAJqvPTvH5NOjyvraW',
                'no_hp' => '-',
                'id_role' => 4,
            ],
            [
                'id' => 5,
                'name' => 'asya',
                'email' => 'asya@gmail.com',
                'password' => '$2y$12$RE7Cu15/uP0eN8rQfitje.LYZ28d8zL5e8sdN.A8ZSJZN8TtrM7ZG',
                'no_hp' => '-',
                'id_role' => 4,
            ],
        ]);

        // 6. Data Table: barang
        DB::table('barang')->insert([
            [
                'id' => 1,
                'nama' => 'routerr',
                'deskripsi' => 'praktek',
                'stok_total' => 20,
                'stok_tersedia' => 6,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 5',
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'id' => 2,
                'nama' => 'lan',
                'deskripsi' => 'praktel',
                'stok_total' => 15,
                'stok_tersedia' => 4,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 6',
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'id' => 3,
                'nama' => 'converter',
                'deskripsi' => 'praktek',
                'stok_total' => 14,
                'stok_tersedia' => 6,
                'id_kondisi_barang' => 1,
                'lokasi' => 'rak 10',
                'created_by' => null,
                'updated_by' => null,
            ],
        ]);

        // 7. Data Table: peminjam
        DB::table('peminjam')->insert([
            [
                'id' => 1,
                'id_barang' => 1,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => 1,
                'created_at' => '2026-05-30 21:22:42',
                'updated_at' => '2026-05-30 21:22:42'
            ],
            [
                'id' => 2,
                'id_barang' => 1,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => null,
                'created_at' => '2026-05-31 20:43:26',
                'updated_at' => '2026-05-31 20:43:26'
            ],
            [
                'id' => 3,
                'id_barang' => 2,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => 2,
                'created_at' => '2026-05-31 21:10:22',
                'updated_at' => '2026-05-31 21:10:22'
            ],
            [
                'id' => 4,
                'id_barang' => 2,
                'id_user' => 4,
                'nim' => '-',
                'nama' => 'yanto',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 4,
                'updated_by' => null,
                'jumlah' => 1,
                'created_at' => '2026-05-31 21:30:33',
                'updated_at' => '2026-05-31 21:30:33'
            ],
            [
                'id' => 5,
                'id_barang' => 1,
                'id_user' => 4,
                'nim' => '-',
                'nama' => 'yanto',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 4,
                'updated_by' => null,
                'jumlah' => 1,
                'created_at' => '2026-05-31 21:30:50',
                'updated_at' => '2026-05-31 21:30:50'
            ],
            [
                'id' => 6,
                'id_barang' => 1,
                'id_user' => 5,
                'nim' => '-',
                'nama' => 'asya',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 5,
                'updated_by' => null,
                'jumlah' => 1,
                'created_at' => '2026-06-01 01:00:42',
                'updated_at' => '2026-06-01 01:00:42'
            ],
            [
                'id' => 7,
                'id_barang' => 1,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => 5,
                'created_at' => '2026-06-01 01:30:17',
                'updated_at' => '2026-06-01 01:30:17'
            ],
            [
                'id' => 8,
                'id_barang' => 3,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => 1,
                'created_at' => '2026-06-01 01:46:42',
                'updated_at' => '2026-06-01 01:46:42'
            ],
            [
                'id' => 9,
                'id_barang' => 2,
                'id_user' => 1,
                'nim' => '-',
                'nama' => 'radit',
                'no_hp' => '-',
                'id_status_mahasiswa' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'jumlah' => 3,
                'created_at' => '2026-06-01 18:36:20',
                'updated_at' => '2026-06-01 18:36:20'
            ]
        ]);

        // 8. Data Table: transaksi
        DB::table('transaksi')->insert([
            ['id' => 3, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 4, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 5, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 6, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 7, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 8, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 9, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => null, 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 10, 'id_peminjam' => 1, 'id_status' => 2, 'tanggal_dipinjam' => '2026-05-31', 'tanggal_dikembalikan' => '2026-05-31', 'created_by' => 1, 'updated_by' => 3],
            ['id' => 11, 'id_peminjam' => 1, 'id_status' => 1, 'tanggal_dipinjam' => '2026-05-31', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => 3],
            ['id' => 12, 'id_peminjam' => 1, 'id_status' => 2, 'tanggal_dipinjam' => '2026-05-31', 'tanggal_dikembalikan' => '2026-06-01', 'created_by' => 1, 'updated_by' => 3],
            ['id' => 13, 'id_peminjam' => 1, 'id_status' => 4, 'tanggal_dipinjam' => '2026-05-31', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 14, 'id_peminjam' => 2, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-01', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 15, 'id_peminjam' => 1, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-02', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 16, 'id_peminjam' => 3, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-03', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 17, 'id_peminjam' => 4, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-01', 'tanggal_dikembalikan' => null, 'created_by' => 4, 'updated_by' => null],
            ['id' => 18, 'id_peminjam' => 5, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-01', 'tanggal_dikembalikan' => null, 'created_by' => 4, 'updated_by' => null],
            ['id' => 19, 'id_peminjam' => 6, 'id_status' => 1, 'tanggal_dipinjam' => '2026-06-04', 'tanggal_dikembalikan' => null, 'created_by' => 5, 'updated_by' => 3],
            ['id' => 20, 'id_peminjam' => 7, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-06', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 21, 'id_peminjam' => 8, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-19', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
            ['id' => 22, 'id_peminjam' => 9, 'id_status' => 4, 'tanggal_dipinjam' => '2026-06-12', 'tanggal_dikembalikan' => null, 'created_by' => 1, 'updated_by' => null],
        ]);

        // 9. Data Table: detail_peminjaman
        DB::table('detail_peminjaman')->insert([
            ['id_detail' => 1, 'id_peminjaman' => 3, 'id_barang' => 1, 'kuantitas_pinjam' => 4, 'kuantitas_kembali' => 0, 'waktu_kembali' => null],
            ['id_detail' => 2, 'id_peminjaman' => 4, 'id_barang' => 2, 'kuantitas_pinjam' => 1, 'kuantitas_kembali' => 0, 'waktu_kembali' => null],
            ['id_detail' => 3, 'id_peminjaman' => 5, 'id_barang' => 3, 'kuantitas_pinjam' => 3, 'kuantitas_kembali' => 0, 'waktu_kembali' => null],
        ]);
    }
}