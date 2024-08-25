<?php

namespace App\Http\Controllers\KantorCabang;

use App\Http\Controllers\Controller;
use App\Imports\DataCabangGajiKaryawanImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class DataCabangGajiKaryawansController extends Controller
{
    public function index($slug)
    {
        // Convert slug to lowercase for table name consistency
        $tableName = strtolower($slug);

        // Check if the table exists
        if (!Schema::hasTable('waktus_' . $tableName)) {
            abort(404, 'Table not found');
        }

        $currentYear = date('Y');
        $startYear = $currentYear - 2;
        $endYear = $currentYear + 2;
        $years = range($startYear, $endYear);

        $data_waktu = DB::table('waktus_' . $tableName)
            ->orderBy('id', 'desc')
            ->get();
        return view('dashboard.tambah-kantor.kantor-cabang.gaji-karyawan.index', compact('data_waktu', 'tableName', 'years'));
    }

    public function store_waktu(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $tableName = 'waktus_' . $request->input('table_name');

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        // Insert data into the dynamic table
        DB::table($tableName)->insert([
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->back()->with('success', 'Data Waktu Berhasil Ditambahkan, Yuk Upload Slip Gaji Excel');
    }

    public function delete_waktus($id_waktu, Request $request)
    {
        // Find the Waktus record
        $table = $request->input('table_name');
        $tableName = 'waktus_' . $request->input('table_name');
        $data_waktu = DB::table($tableName)->where('id', $id_waktu)->first();

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        DB::table($tableName)->where('id', $id_waktu)->delete();

        DB::table('karyawan_' . $table)->where('id_waktu', $id_waktu)->delete();

        // Redirect back with success message
        return redirect()->back()->with('danger', 'Data Gaji Berhasil Dihapus');
    }

    public function detail($slug, $id)
    {
        $tableName = strtolower($slug);

        // Check if the table exists
        if (!Schema::hasTable('waktus_' . $tableName)) {
            abort(404, 'Table not found');
        }

        $waktu = DB::table('waktus_' . $tableName)->where('id', $id)->first();
        $data_gaji = DB::table('karyawan_' . $tableName)->where('id_waktu', $id)->get();
        return view('dashboard.tambah-kantor.kantor-cabang.gaji-karyawan.detail', compact('tableName', 'waktu', 'data_gaji'));
    }

    public function detail_gaji($slug, $id, $id_waktu)
    {

        $tableName = strtolower($slug);

        // Check if the table exists
        if (!Schema::hasTable('waktus_' . $tableName)) {
            abort(404, 'Table not found');
        }
        $karyawan = 'karyawan_' . $tableName;
        $waktu = 'waktus_' . $tableName;

        $gaji = DB::table($karyawan)
            ->join($waktu, $waktu . '.id', '=', $karyawan . '.id_waktu')
            ->where($waktu . '.id', $id)
            ->where($karyawan . '.id', $id_waktu)
            ->first();

        return view('dashboard.tambah-kantor.kantor-cabang.gaji-karyawan.detail_gaji', compact('tableName', 'gaji', 'id_waktu'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'tableName' => 'required|string',
            'file' => 'required|file|mimes:csv,xls,xlsx,txt', // Added max size validation
            'id_waktu' => 'required|integer', // Assuming id_waktu is required
        ]);

        $id_waktu = $request->input('id_waktu');
        $tableName = $request->input('tableName');
        $file = $request->file('file');

        // Pass both id_waktu and tableName to the import class
        Excel::import(new DataCabangGajiKaryawanImport($id_waktu, $tableName), $file);

        return redirect()->back()->with('success', 'File Sukses Ter-Upload!');
    }
    public function delete(Request $request, $id_waktu)
    {
        $tableName = 'karyawan_' . $request->input('table_name');

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        // Delete all records with the specified id_waktu
        DB::table($tableName)->where('id_waktu', $id_waktu)->delete();

        // Redirect back with success message
        return redirect()->back()->with('danger', 'Data Gaji Berhasil Dihapus');
    }
    public function update(Request $request, $id, $id_waktu)
    {
        $tableName = 'karyawan_' . $request->input('table_name');

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        // Retrieve the record
        $karyawan = DB::table($tableName)->where('id_waktu', $id_waktu)->where('id', $id)->first();

        if (!$karyawan) {
            return redirect()->back()->with('error', 'Record not found!');
        }

        // Update the record
        DB::table($tableName)->where('id_waktu', $id_waktu)->where('id', $id)->update($request->except(['_token', '_method', 'table_name']));

        return redirect()->back()->with('success', 'Data Berhasil Di-update');
    }


    public function print_slip($id, $id_waktu, $table_name)
    {
        $tableName = 'karyawan_' . $table_name;
        $table_name = $table_name;
        $karyawanTable = 'karyawan_' . $table_name;
        $waktusTable = 'waktus_' . $table_name;

        // Check if the table exists
        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('error', 'Table does not exist!');
        }

        $data_gaji = DB::table($karyawanTable)
            ->join($waktusTable, $waktusTable . '.id', '=', $karyawanTable . '.id_waktu')
            ->where($waktusTable . '.id', $id)
            ->where($karyawanTable . '.id', $id_waktu)
            ->first();


        // Generate the URL for the original image file
        $imagePath = ('img/logo.jpg');

        // Open the original image
        $originalImage = imagecreatefromjpeg($imagePath);

        // Get the original image dimensions
        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);

        // Define the desired width and height for the resized image
        $newWidth = 100; // Adjust according to your requirements
        $newHeight = 100; // Adjust according to your requirements

        // Create a new image resource with the desired dimensions
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        // Resize the original image to the new dimensions
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

        // Save the resized image to a temporary file
        $tempImagePath = tempnam(sys_get_temp_dir(), 'resized_image');
        imagejpeg($resizedImage, $tempImagePath);

        // Encode the resized image to base64
        $imageData = base64_encode(file_get_contents($tempImagePath));
        $imageSrc = 'data:image/jpeg;base64,' . $imageData; // Specify image type

        // Clean up - delete the temporary file and destroy image resources
        unlink($tempImagePath);
        imagedestroy($originalImage);
        imagedestroy($resizedImage);

        $pdf = Pdf::loadView('dashboard.tambah-kantor.kantor-cabang.gaji-karyawan.print.pdf', [
            'gaji' => $data_gaji,
            'imageSrc' => $imageSrc,
            'tableName' => $table_name
        ]); // Pass $gaji as an array to the view

        return $pdf->download('Slip-Gaji-' . $data_gaji->nama . '-' . $data_gaji->bulan . '-' . $data_gaji->tahun . '.pdf');
    }
}
