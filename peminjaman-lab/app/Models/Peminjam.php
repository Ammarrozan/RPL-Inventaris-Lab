<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{


    protected $table = 'peminjam';
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function statusMahasiswa()
    {
        return $this->belongsTo(StatusMahasiswa::class, 'id_status_mahasiswa');
    }
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_peminjam');
    }
}
