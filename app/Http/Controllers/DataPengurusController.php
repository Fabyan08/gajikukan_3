<?php

namespace App\Http\Controllers;

use App\Imports\DataPengurusPengawasImport;
use App\Models\data_pengurus_pengawas;
use Illuminate\Http\Request;
use Excel;

class DataPengurusController extends Controller
{
    public function index(Request $request)
    {
        $data = data_pengurus_pengawas::where('status', '=', 'Aktif')->get();
        return view('dashboard.master-karyawan.pengurus-pengawas.index')->with('karyawan', $data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new DataPengurusPengawasImport(), $request->file('file'));

        return redirect()->back()->with('success', 'File Sukses Ter-Upload!');
    }
    public function delete()
    {
        data_pengurus_pengawas::truncate();
        return redirect()->back()->with('delete', 'Semua Data Berhasil Dihapus, Silahkan Upload Ulang!');
    }
    public function nonaktif($id)
    {
        data_pengurus_pengawas::where('id', $id)->update(['status' => 'Tidak Aktif']);
        return redirect()->back()->with('danger', 'Berhasil Dinonaktifkan.');
    }


    public function update(Request $request, $id)
    {
        data_pengurus_pengawas::where('id', $id)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
        ]);
        return redirect()->back()->with('update', '1 Data Berhasil Diedit!');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        data_pengurus_pengawas::create($request->all());

        return redirect()->back()->with('success', '1 Data Berhasil Ditambahkan!');
    }
    public function delete_id($id)
    {
        data_pengurus_pengawas::where('id', $id)->delete();
        return redirect()->back()->with('delete_id', '1 Data Pengurus / Pengawas Berhasil Dihapus.');
    }
}
