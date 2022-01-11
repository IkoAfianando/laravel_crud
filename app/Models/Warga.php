<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'foto',
        'alamat',
        'tanggal_lahir',
        'email',
        'jenis_kelamin',
        'status_pernikahan',
        'status_warga',
    ];
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
