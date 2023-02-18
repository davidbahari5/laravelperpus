<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';
    protected $primaryKey = 'id_penerbit';
    protected $fillable = ['id_penerbit','nama','email','alamat','soft_delete'];
}
