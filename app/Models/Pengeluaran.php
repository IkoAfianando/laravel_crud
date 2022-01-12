<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengeluaran',
        'nama_input_pengeluaran',
        'jumlah_pengeluaran',
        'kategori',
        'tanggal_pengeluaran',
        'foto'
    ];
}
