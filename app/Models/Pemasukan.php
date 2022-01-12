<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_rumah',
        'nama_pemilik',
        'alamat',
        'iuran',
        'tanggal_pemasukan'
    ];
}
