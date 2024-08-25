<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_pengurus_pengawas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'alamat',
        'kontak',
        'status'
    ];
}
