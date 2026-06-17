<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    protected $table = 'barang';
    protected $fillable = ['nama', 'deskripsi', 'stok_total', 'stok_tersedia','id_kondisi_barang', 'lokasi','created_by','updated_by','kode'];

    public function kondisi()
    {
        return $this->belongsTo(kondisibarang::class, 'id_kondisi_barang');
    }
}
