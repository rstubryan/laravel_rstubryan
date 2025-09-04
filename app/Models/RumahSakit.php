<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakit';
    protected $fillable = ['nama_rumah_sakit', 'alamat', 'email', 'telepon'];

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'rumah_sakit_id');
    }

    public function pasiens()
    {
        return $this->hasMany(Pasien::class, 'rumah_sakit_id');
    }
}
