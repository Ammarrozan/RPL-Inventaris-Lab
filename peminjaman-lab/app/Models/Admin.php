<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';
    protected $fillable = ['nama', 'nim', 'no_hp', 'role'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}
