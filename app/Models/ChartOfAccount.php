<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use HasFactory;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'id_karyawan',
        'nama',
        'jenis_kelamin',
        'jabatan',
        'divisi',
        'masa_kerja',
        'status_karyawan',
        'alamat',
        'npwp',
        'email',
    ];
}
