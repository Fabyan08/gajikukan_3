<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pph', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->string('penghasilan_bruto_bulan');
            $table->string('penghasilan_disetahunkan');
            $table->string('bonus');
            $table->string('thr');
            $table->string('penghasilan_bruto');
            $table->string('pengurangan_biaya_jabatan');
            $table->string('jumlah_penghasilan_neto_sebulan');
            $table->string('ptkp');
            $table->string('ptkp_disetahunkan');
            $table->string('pph_21');
            $table->string('iuran_per_bulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
