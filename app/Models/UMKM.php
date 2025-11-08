<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    protected $table = 'u_m_k_m_s';
    protected $fillable = ['judul', 'deskripsi', 'gambar'];
}
