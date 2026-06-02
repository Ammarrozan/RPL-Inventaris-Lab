<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{

    protected $table = 'transaksi';
    protected $casts = [
    'tanggal_dipinjam'     => 'string',
    'tanggal_dikembalikan' => 'string',
];
    protected $fillable = ['id_peminjam', 'id_status','tanggal_dipinjam','tanggal_dikembalikan','created_by','updated_by'];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam');
    }

    public function status()
    {
        return $this->belongsTo(StatusPeminjam::class, 'id_status');
    }

    public function details(){
        return $this->belongsTo(Peminjam::class, 'id_peminjam','id');
    }


}
