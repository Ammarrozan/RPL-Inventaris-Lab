<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiBarang extends Model
{
    protected $table = 'kondisi_barang';
    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_kondisi_barang');
    }
}
