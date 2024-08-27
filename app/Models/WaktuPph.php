<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPph extends Model
{
    use HasFactory;

    protected $table = 'waktu_pph';

    protected $fillable = [
        'tanggal',
        'bulan',
        'tahun',
    ];
}
