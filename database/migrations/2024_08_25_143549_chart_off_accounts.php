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
        Schema::create('chart_off_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('id_karyawan');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('jabatan');
            $table->string('divisi');
            $table->string('masa_kerja');
            $table->string('status_karyawan');
            $table->string('alamat');
            $table->string('npwp');
            $table->string('email');
            $table->timestamps();
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
