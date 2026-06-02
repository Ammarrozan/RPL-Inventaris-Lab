<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $primaryKey = 'id_detail';
    public $timestamps = false;
    protected $fillable = ['id_peminjaman', 'id_barang', 'kuantitas_pinjam', 'kuantitas_kembali', 'waktu_kembali'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
