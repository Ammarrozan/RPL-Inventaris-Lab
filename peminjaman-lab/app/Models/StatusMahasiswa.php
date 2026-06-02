<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusMahasiswa extends Model
{
    protected $table = 'status_mahasiswa';
    protected $fillable = ['nama'];

    public function peminjams()
    {
        return $this->hasMany(Peminjam::class, 'id_status_mahasiswa');
    }
}
