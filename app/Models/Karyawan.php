<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_waktu',
        'nama',
        'jabatan',
        'gaji_pokok',
        'tunjangan_makan',
        'tunjangan_transport',
        'tunjangan_senja',
        'tunjangan_hadir',
        'tunjangan_jabatan',
        'tunjangan_komunikasi',
        'tunjangan_natura',
        'reward_lending',
        'reward_funding',
        'bpjs_tk',
        'bpjs_kesehatan',
        'gaji_kotor',
        'potongan_bpjs_tk_kesehatan',
        'potongan_angsuran',
        'potongan_ijin',
        'potongan_zis',
        'potongan_pensiun',
        'total_potongan',
        'gaji_bersih'
    ];
    public function waktus()
    {
        return $this->belongsTo(Waktus::class, 'id_waktu');
    }
}
