<?php

namespace App\Http\Controllers;

use App\Models\data_karyawans;
use App\Models\data_pengurus_pengawas;
use Illuminate\Http\Request;

class TidakAktifController extends Controller
{
    public function index()
    {
        $karyawan_aktif = data_karyawans::where('status', '=', 'Tidak Aktif')->get()->toArray();
        $pengurus_pengawas_aktif = data_pengurus_pengawas::where('status', '=', 'Tidak Aktif')->get()->toArray();

        // Merge the arrays
        $combinedData = array_merge($karyawan_aktif, $pengurus_pengawas_aktif);

        // Sort the combined array by the 'nama_lengkap' attribute in ascending order
        usort($combinedData, function ($a, $b) {
            return $a['nama_lengkap'] <=> $b['nama_lengkap'];
        });
        return view('dashboard.master-karyawan.tidak-aktif.index', ['data' => $combinedData]);
    }
    public function aktifkan(Request $request, $id)
    {
        $badge = $request->badge;
        if ($badge == 'Pengurus & Pengawas') {
            data_pengurus_pengawas::where('id', $id)->update(['status' => 'Aktif']);
        } else {
            data_karyawans::where('id', $id)->update(['status' => 'Aktif']);
        }
        return redirect()->back()->with('success', 'Berhasil Diaktifkan Kembali.');
    }
}
