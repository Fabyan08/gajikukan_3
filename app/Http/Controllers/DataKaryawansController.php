<?php

namespace App\Http\Controllers;

use App\Imports\DataKaryawanImport;
use App\Models\data_karyawans;
use Illuminate\Http\Request;
use Excel;

class DataKaryawansController extends Controller
{
    public function index(Request $request)
    {
        $data = data_karyawans::where('status', '=', 'Aktif')->get();
        return view('dashboard.master-karyawan.karyawan.index')->with('karyawan', $data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new DataKaryawanImport(), $request->file('file'));

        return redirect()->back()->with('success', 'File Sukses Ter-Upload!');
    }
    public function delete()
    {
        data_karyawans::truncate();
        return redirect()->back()->with('delete', 'Semua Data Berhasil Dihapus, Silahkan Upload Ulang!');
    }
    public function nonaktif($id)
    {
        data_karyawans::where('id', $id)->update(['status' => 'Tidak Aktif']);
        return redirect()->back()->with('danger', 'Karyawan Berhasil Dinonaktifkan.');
    }


    public function update(Request $request, $id)
    {
        data_karyawans::where('id', $id)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ]);
        return redirect()->back()->with('update', '1 Data Karyawan Berhasil Diedit!');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        data_karyawans::create($request->all());

        return redirect()->back()->with('success', '1 Data Karyawan Berhasil Ditambahkan!');
    }

    public function delete_id($id)
    {
        data_karyawans::where('id', $id)->delete();
        return redirect()->back()->with('delete_id', '1 Data Karyawan Berhasil Dihapus.');
    }
}
