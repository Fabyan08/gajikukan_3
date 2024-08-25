<?php

namespace App\Http\Controllers\KantorCabang;

use App\Http\Controllers\Controller;
use App\Imports\DataCabangKaryawanImport;
use App\Imports\DataKaryawanImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class DataCabangKaryawansController extends Controller
{
    // Karyawan
    public function data_karyawan($slug)
    {
        // Convert slug to lowercase for table name consistency
        $tableName = strtolower($slug);

        // Check if the table exists
        if (!Schema::hasTable('data_karyawans_' . $tableName)) {
            abort(404, 'Table not found');
        }

        // Fetch data from the table
        $karyawan = DB::table('data_karyawans_' . $tableName)->where('status', '=', 'Aktif')->get();

        // $data = data_karyawans::where('status', '=', 'Aktif')->get();


        return view('dashboard.tambah-kantor.kantor-cabang.karyawan', compact('karyawan', 'tableName'));
    }

    public function insert_karyawan(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:1000',
            'kontak' => 'required|numeric',
            'table_name' => 'required|string|max:255',
        ]);

        $tableName = 'data_karyawans_' . $request->input('table_name');

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        // Insert data into the dynamic table
        DB::table($tableName)->insert([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jabatan' => $request->input('jabatan'),
            'alamat' => $request->input('alamat'),
            'kontak' => $request->input('kontak'),
            'status' => 'Aktif', // Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', '1 Data Karyawan Berhasil Ditambahkan!');
    }

    public function delete_karyawan(Request $request)
    {
        // dd($request->all());
        // Validate that the table_name is present
        $request->validate([
            'table_name' => 'required|string|max:255',
        ]);

        $tableName = 'data_karyawans_' . $request->input('table_name');

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        // Delete all records from the dynamic table
        DB::table($tableName)->truncate();

        return redirect()->back()->with('delete', 'Semua Data Berhasil Dihapus, Silahkan Upload Ulang!');
    }
    public function import_karyawan(Request $request)
    {
        $request->validate([
            'tableName' => 'required|string',
            'file' => 'required|file|mimes:csv,xls,xlsx,txt',
        ]);
        // dd($request->all());
        $tableName = $request->input('tableName');
        $file = $request->file('file');
        // Excel::import(new DataCabangKaryawanImport(), $request->file('file'), $request->input('tableName'));
        Excel::import(new DataCabangKaryawanImport($tableName), $file);

        return redirect()->back()->with('success', 'File Sukses Ter-Upload!');
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'table_name' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
        ]);

        // Construct the table name
        $tableName = 'data_karyawans_' . $request->input('table_name');

        // Perform the update using the DB facade
        DB::table($tableName)->where('id', $id)->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jabatan' => $request->input('jabatan'),
            'alamat' => $request->input('alamat'),
            'kontak' => $request->input('kontak'),
        ]);

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Data successfully updated!');
    }

    public function nonaktif(Request $request, $id)
    {
        $request->validate([
            'table_name' => 'required|string|max:255',
        ]);

        $tableName = 'data_karyawans_' . $request->input('table_name');
        DB::table($tableName)->where('id', $id)->update(['status' => 'Tidak Aktif']);
        return redirect()->back()->with('danger', 'Karyawan Berhasil Dinonaktifkan.');
    }

    public function delete_id(Request $request, $id)
    {

        $request->validate([
            'table_name' => 'required|string|max:255',
        ]);

        $tableName = 'data_karyawans_' . $request->input('table_name');
        DB::table($tableName)->where('id', $id)->delete();
        return redirect()->back()->with('delete_id', '1 Data Karyawan Berhasil Dihapus.');
    }
}
