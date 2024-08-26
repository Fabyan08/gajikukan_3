<?php

namespace App\Http\Controllers;

use App\Imports\ChartofAccountImport;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;

use Excel;

class ChartOfAccountController extends Controller
{
    public function index()
    {
        $coa = ChartOfAccount::all();
        return view('dashboard.chart-account.index', compact('coa'));
    }

    public function create(Request $request)
    {


        $request->validate([
            'id_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'masa_kerja' => 'required',
            'status_karyawan' => 'required',
            'alamat' => 'required',
            'npwp' => 'required',
            'email' => 'required',
        ]);

        ChartOfAccount::create([
            'id_karyawan' => $request->input('id_karyawan'),
            'nama' => $request->input('nama_karyawan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'jabatan' => $request->input('jabatan'),
            'divisi' => $request->input('divisi'),
            'masa_kerja' => $request->input('masa_kerja'),
            'status_karyawan' => $request->input('status_karyawan'),
            'alamat' => $request->input('alamat'),
            'npwp' => $request->input('npwp'),
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Berhasil ditambahkan!');
    }

    public function detail($id)
    {

        $coa = ChartOfAccount::find($id);
        return view('dashboard.chart-account.detail', compact('coa'));
    }

    public function delete($id)
    {

        $coa = ChartOfAccount::find($id);
        $coa->delete();
        return redirect('/chart-account')->with('success', 'Berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'id_karyawan' => 'required',
            'nama_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
            'masa_kerja' => 'required',
            'status_karyawan' => 'required',
            'alamat' => 'required',
            'npwp' => 'required',
            'email' => 'required',
        ]);

        $coa = ChartOfAccount::find($id);
        $coa->update([
            'id_karyawan' => $request->input('id_karyawan'),
            'nama' => $request->input('nama_karyawan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'jabatan' => $request->input('jabatan'),
            'divisi' => $request->input('divisi'),
            'masa_kerja' => $request->input('masa_kerja'),
            'status_karyawan' => $request->input('status_karyawan'),
            'alamat' => $request->input('alamat'),
            'npwp' => $request->input('npwp'),
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Berhasil diupdate!');
    }

    public function delete_all(Request $request)
    {

        $coa = ChartOfAccount::truncate();
        return redirect('/chart-account')->with('success', 'Berhasil dihapus semua.');
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv,txt',
        ]);

        $file = $request->file('file');
        Excel::import(new ChartofAccountImport(), $file);

        return redirect('/chart-account')->with('success', 'Berhasil diimport.');
    }
}
