<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TambahKantorCabangController extends Controller
{
    public function index()
    {
        $tables = DB::select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                if (strpos($value, 'karyawan_') === 0 || strpos($value, 'pengurus_pengawas_') === 0 || strpos($value, 'data_karyawans_') === 0 || strpos($value, 'data_pengurus_pengawas_') === 0) {
                    // Remove the prefixes to get only the suffix
                    $suffix = preg_replace('/^(karyawan_|pengurus_pengawas_|data_karyawans_|data_pengurus_pengawas_)/', '', $value);
                    $tableList[] = strtoupper($suffix);
                }
            }
        }

        // Remove duplicate suffixes
        $tableList = array_unique($tableList);
        return view('dashboard.tambah-kantor.index', compact('tableList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tabel' => 'required|string|max:255',
        ]);
        // dd($request->all());
        $tableName = $request->input('nama_tabel');
        Schema::create('karyawan_' . $tableName, function ($table) {
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

        Schema::create('pengurus_pengawas_' . $tableName, function ($table) {
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

        Schema::create('data_karyawans_' . $tableName, function ($table) {
            $table->id();
            $table->string('id_karyawan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });

        Schema::create('data_pengurus_pengawas_' . $tableName, function ($table) {
            $table->id();
            $table->string('id_karyawan')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });

        Schema::create('waktus_' . $tableName, function ($table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->timestamps();
        });
        Schema::create('waktus_pengurus_pengawas_' . $tableName, function ($table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->timestamps();
        });

        return redirect()->back()->with('success', 'Table created successfully');
    }

    public function destroy(Request $request)
    {
        $tableName = strtolower($request->input('table_name'));

        // Prefixes for different table types
        $prefixes = ['karyawan_', 'pengurus_pengawas_', 'data_karyawans_', 'data_pengurus_pengawas_', 'waktus_', 'waktus_pengurus_pengawas_'];

        foreach ($prefixes as $prefix) {
            Schema::dropIfExists($prefix . $tableName);
        }

        return redirect()->back()->with('delete_success', 'Tables deleted successfully');
    }

    // Detail

}
