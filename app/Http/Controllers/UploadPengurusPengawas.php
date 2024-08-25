<?php

namespace App\Http\Controllers;

use App\Imports\PengurusPengawasImport;
use App\Models\PengurusPengawas;
use App\Models\Waktus;
use App\Models\WaktusPengurusPengawas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Storage;

class UploadPengurusPengawas extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $startYear = $currentYear - 2;
        $endYear = $currentYear + 2;
        $years = range($startYear, $endYear);
        $data_waktu = WaktusPengurusPengawas::all()->sortByDesc('id');
        return view('dashboard.upload.upload-pengurus-pengawas.index')->with('years', $years)->with('data_waktu', $data_waktu);
    }

    public function detail($id)
    {
        $waktu = WaktusPengurusPengawas::where('id', $id)->first();
        $data_gaji = PengurusPengawas::where('id_waktu', $id)->get();
        return view('dashboard.upload.upload-pengurus-pengawas.detail')->with('waktu', $waktu)->with('data_gaji', $data_gaji);
    }

    public function detail_gaji($id, $id_waktu)
    {
        $data_gaji = DB::table('pengurus_pengawas')
            ->join('waktus_pengurus_pengawas', 'waktus_pengurus_pengawas.id', '=', 'pengurus_pengawas.id_waktu')
            ->where('waktus_pengurus_pengawas.id', $id)
            ->where('pengurus_pengawas.id', $id_waktu)
            ->first();

        return view('dashboard.upload.upload-pengurus-pengawas.detail_gaji')->with('gaji', $data_gaji)->with('id_waktu', $id_waktu);
    }

    public function print_slip($id, $id_waktu)
    {
        $data_gaji = DB::table('pengurus_pengawas')
            ->join('waktus_pengurus_pengawas', 'waktus_pengurus_pengawas.id', '=', 'pengurus_pengawas.id_waktu')
            ->where('waktus_pengurus_pengawas.id', $id)
            ->where('pengurus_pengawas.id', $id_waktu)
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

        $pdf = Pdf::loadView('dashboard.upload.upload-pengurus-pengawas.print.pdf', [
            'gaji' => $data_gaji,
            'imageSrc' => $imageSrc, // Pass the base64-encoded image source to the view
        ]);
        return $pdf->download('Slip-Gaji-' . $data_gaji->nama . '-' . $data_gaji->bulan . '-' . $data_gaji->tahun . '.pdf');
    }


    public function delete($id_waktu)
    {
        // Retrieve all data with the specified id_waktu
        $data_gaji = PengurusPengawas::where('id_waktu', $id_waktu)->get();

        // Delete all records
        $data_gaji->each->delete();

        // Redirect back with success message
        return redirect()->back()->with('danger', 'Data Gaji Berhasil Dihapus');
    }

    public function delete_waktus($id_waktu)
    {
        // Find the Waktus record
        $data_waktu = WaktusPengurusPengawas::findOrFail($id_waktu);

        // Delete all associated data_gaji records
        $data_waktu->data_gaji()->delete();

        // Delete the Waktus record
        $data_waktu->delete();

        // Redirect back with success message
        return redirect()->back()->with('danger', 'Data Gaji Berhasil Dihapus');
    }



    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx,txt|max:2048', // Added max size validation
            'id_waktu' => 'required', // Assuming id_waktu is required
        ]);


        // dd(1);
        $id_waktu = $request->id_waktu;

        Excel::import(new PengurusPengawasImport($id_waktu), $request->file('file'));


        return redirect()->back()->with('success', 'File Sukses Ter-Upload!');
    }

    public function store_waktu(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        WaktusPengurusPengawas::create([
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        return redirect()->back()->with('success', 'Data Waktu Berhasil Ditambahkan, Yuk Upload Slip Gaji Excel');
    }

    public function update(Request $request, $id, $id_waktu)
    {
        $karyawan = PengurusPengawas::where('id_waktu', $id)
            ->where('id', $id_waktu)
            ->firstOrFail(); // Use firstOrFail() to retrieve the model or throw a 404 error if not found

        $karyawan->update($request->all());
        // dd($request->all());
        return redirect()->back()->with('success', 'Data Waktu Berhasil Diupdate');
    }
}
