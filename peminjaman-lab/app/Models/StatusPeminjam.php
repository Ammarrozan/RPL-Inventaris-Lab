<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPeminjam extends Model
{
    protected $table = 'status_peminjam';
    protected $fillable = ['nama'];

    public function transaksis()
    {
        return $this->hasMany(transaksi::class, 'id_status');
    }
}
