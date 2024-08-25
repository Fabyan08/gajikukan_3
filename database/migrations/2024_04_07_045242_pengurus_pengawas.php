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
        Schema::create('pengurus_pengawas', function (Blueprint $table) {
            $table->id();
            $table->string('id_waktu');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('gaji_pokok');
            // Tunjangan
            $table->string('tunjangan_bpjs_kesehatan');
            $table->string('tunjangan_bpjs_tk_jp');
            $table->string('tunjangan_transport');
            $table->string('tunjangan_makan');
            $table->string('tunjangan_jabatan');
            $table->string('tunjangan_lain_lain');
            $table->string('tunjangan_natura');
            $table->string('tunjangan_kesehatan');
            // gaji kotor
            $table->string('gaji_kotor');
            // Potongan
            $table->string('potongan_bpjs_tk_kesehatan');
            $table->string('potongan_angsuran');
            $table->string('potongan_zis');
            $table->string('potongan_tabungan_pensiun');
            $table->string('total_potongan');
            // Gaji Bersih
            $table->string('gaji_bersih');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_pengawas');
    }
};
