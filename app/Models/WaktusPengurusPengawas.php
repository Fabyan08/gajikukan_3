<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class WaktusPengurusPengawas extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'waktus_pengurus_pengawas'; // Specify the table name explicitly

    protected $fillable = [
        'tanggal',
        'bulan',
        'tahun',

    ];
    public function data_gaji()
    {
        return $this->hasMany(PengurusPengawas::class, 'id_waktu');
    }
}
