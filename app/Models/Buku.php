<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = ['id_buku','judul','id_pengarang','id_penerbit','keterangan','stock','status','gambar','soft_delete'];

    public function Pengarang()
    {
        return $this->hasOne(Pengarang::class, 'id_pengarang', 'id_pengarang');
    }

    public function Penerbit()
    {
        return $this->hasOne(Penerbit::class, 'id_penerbit', 'id_penerbit');
    }
}
