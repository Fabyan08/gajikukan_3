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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('id_waktu');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('gaji_pokok');
            // Tunjangan
            $table->string('tunjangan_makan');
            $table->string('tunjangan_transport');
            $table->string('tunjangan_senja');
            $table->string('tunjangan_hadir');
            $table->string('tunjangan_jabatan');
            $table->string('tunjangan_komunikasi');
            $table->string('tunjangan_natura');

            // Reward
            $table->string('reward_lending');
            $table->string('reward_funding');
            // BPJS
            $table->string('bpjs_tk');
            $table->string('bpjs_kesehatan');
            // gaji
            $table->string('gaji_kotor');
            // Potongan
            $table->string('potongan_bpjs_tk_kesehatan');
            $table->string('potongan_angsuran');
            $table->string('potongan_ijin');
            $table->string('potongan_zis');
            $table->string('potongan_pensiun');
            // Total
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
        Schema::dropIfExists('karyawans');
    }
};
