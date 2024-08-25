<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusPengawas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_waktu',
        'nama',
        'jabatan',
        'gaji_pokok',

        'tunjangan_bpjs_kesehatan',
        'tunjangan_bpjs_tk_jp',
        'tunjangan_makan',
        'tunjangan_transport',
        'tunjangan_jabatan',
        'tunjangan_lain_lain',
        'tunjangan_natura',
        'tunjangan_kesehatan',

        'gaji_kotor',

        'potongan_bpjs_tk_kesehatan',
        'potongan_angsuran',
        'potongan_zis',
        'potongan_tabungan_pensiun',

        'total_potongan',

        'gaji_bersih'
    ];
    public function waktus()
    {
        return $this->belongsTo(WaktusPengurusPengawas::class, 'id_waktu');
    }
}
