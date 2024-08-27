<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pph extends Model
{
    use HasFactory;

    protected $table = 'pph';

    protected $fillable = [
        'nama_pegawai',
        'penghasilan_bruto_bulan',
        'penghasilan_disetahunkan',
        'bonus',
        'thr',
        'penghasilan_bruto',
        'pengurangan_biaya_jabatan',
        'jumlah_penghasilan_neto_sebulan',
        'ptkp',
        'ptkp_disetahunkan',
        'pph_21',
        'iuran_per_bulan',
    ];
}
