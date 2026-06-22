<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barang';

    protected $fillable = [
        'kode', // Tambahkan ini juga biar aman karena di controller lu insert kode otomatis
        'nama',
        'deskripsi',
        'stok_total',
        'stok_tersedia',
        'id_kondisi_barang',
        'lokasi',
        'created_by',
        'updated_by'
    ];

    // Relasi ke tabel kondisi barang
    public function kondisi()
    {
        return $this->belongsTo(KondisiBarang::class, 'id_kondisi_barang');
    }

    // TUNTASIN ERROR: Tambah relasi ke tabel peminjam (sesuaikan nama model peminjam lu)
    public function peminjam()
    {
        // Ganti 'Peminjam::class' di bawah ini dengan nama Model Transaksi/Peminjaman lu yang sebenernya kalau namanya beda
        return $this->hasMany(\App\Models\Transaksi::class, 'id_barang');
    }
}
