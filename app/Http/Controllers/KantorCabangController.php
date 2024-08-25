<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KantorCabangController extends Controller
{
    public function show($slug)
    {
        // Convert slug to lowercase for table name consistency
        $tableName = strtolower($slug);

        // Check if the table exists
        if (
            !Schema::hasTable('karyawan_' . $tableName) &&
            !Schema::hasTable('pengurus_pengawas_' . $tableName) &&
            !Schema::hasTable('data_karyawans_' . $tableName) &&
            !Schema::hasTable('data_pengurus_pengawas_' . $tableName)
        ) {
            abort(404, 'Table not found');
        }

        // Fetch data from the tables, for example purposes:
        $karyawanData = DB::table('karyawan_' . $tableName)->get();
        $pengurusPengawasData = DB::table('pengurus_pengawas_' . $tableName)->get();
        $dataKaryawans = DB::table('data_karyawans_' . $tableName)->get();
        $dataPengurusPengawas = DB::table('data_pengurus_pengawas_' . $tableName)->get();

        return view('dashboard.tambah-kantor.kantor-cabang.index', compact(
            'karyawanData',
            'pengurusPengawasData',
            'dataKaryawans',
            'dataPengurusPengawas',
            'tableName'
        ));
    }
}
