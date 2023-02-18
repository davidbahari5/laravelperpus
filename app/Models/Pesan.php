<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';
    protected $fillable = ['id_pesan','id_anggota','email_penyewa','status','tanggal','soft_delete'];

    public function Anggota()
    {
        return $this->hasOne(Anggota::class, 'id_anggota', 'id_anggota');        
    }

    public function Buku()
    {
        return $this->hasOne(Buku::class, 'id_buku', 'id_buku');
    }
}
