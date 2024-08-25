<?php

namespace App\Http\Controllers\KantorCabang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataCabangNonaktifKaryawanPengurusController extends Controller
{
    public function index($slug)
    {
        // Convert slug to lowercase for table name consistency
        $tableName = strtolower($slug);

        // Check if the table exists
        if (!Schema::hasTable('data_karyawans_' . $tableName)) {
            abort(404, 'Table not found');
        }

        // Fetch karyawan data and add badge
        $karyawan_aktif = DB::table('data_karyawans_' . $tableName)
            ->where('status', '=', 'Tidak Aktif')
            ->get()
            ->map(function ($item) {
                $item->badge = 'Karyawan';
                return (array) $item;
            })
            ->toArray();

        // Fetch pengurus_pengawas data and add badge
        $pengurus_pengawas_aktif = DB::table('data_pengurus_pengawas_' . $tableName)
            ->where('status', '=', 'Tidak Aktif')
            ->get()
            ->map(function ($item) {
                $item->badge = 'Pengurus & Pengawas';
                return (array) $item;
            })
            ->toArray();

        // Merge the arrays
        $combinedData = array_merge($karyawan_aktif, $pengurus_pengawas_aktif);

        // Sort the combined array by the 'nama_lengkap' attribute in ascending order
        usort($combinedData, function ($a, $b) {
            return $a['nama_lengkap'] <=> $b['nama_lengkap'];
        });

        return view('dashboard.tambah-kantor.kantor-cabang.karyawan_pengurus_tidak_aktif', ['data' => $combinedData, 'tableName' => $tableName]);
    }


    public function aktifkan(Request $request, $id)
    {
        $request->validate([
            'tableName' => 'required',
        ]);


        $tableName = strtolower($request->tableName);

        // Check if the table exists
        if (!Schema::hasTable('data_karyawans_' . $tableName)) {
            abort(404, 'Table not found');
        }

        $badge = $request->badge;
        // dd($badge);
        if ($badge == 'Pengurus & Pengawas') {
            DB::table('data_pengurus_pengawas_' . $tableName)->where('id', $id)->update(['status' => 'Aktif']);
        } else {
            DB::table('data_karyawans_' . $tableName)->where('id', $id)->update(['status' => 'Aktif']);
        }
        return redirect()->back()->with('success', 'Berhasil Diaktifkan Kembali.');
    }
}
