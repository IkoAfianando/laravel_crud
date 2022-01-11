<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_rumah',
        'foto',
        'alamat',
        'nama_pemilik',
        'nama_penghuni'
    ];
    public function rumah()
    {
        return $this->hasMany(Warga::class);
    }

}
