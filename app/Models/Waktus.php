<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Waktus extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'waktus'; // Specify the table name explicitly

    protected $fillable = [
        'tanggal',
        'bulan',
        'tahun',

    ];
    public function data_gaji()
    {
        return $this->hasMany(Karyawan::class, 'id_waktu');
    }
}
