<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
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
                    $tableList[] = strtolower($suffix);
                }
            }
        }

        // Remove duplicate suffixes
        $tableList = array_unique($tableList);
        return view('dashboard.laporan.index', compact('tableList'));
    }

    public function print(Request $request)
    {
        $kantor = $request->input('kantor');
        $bulan = $request->input('bulan');
        $date = DateTime::createFromFormat('Y-m', $bulan);
        $date_year = DateTime::createFromFormat('Y-m', $bulan);
        $indonesianMonths = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $monthName = $indonesianMonths[$date->format('n') - 1];
        $date = $monthName . '-' . $date->format('Y');
        $month = $monthName;
        $year = $date_year->format('Y');

        if ($kantor == 'pusat') {
            $gaji_karyawan = DB::table('karyawans')
                ->join('waktus', 'waktus.id', '=', 'karyawans.id_waktu')
                ->where(DB::raw("CONCAT(waktus.bulan, '-', waktus.tahun)"), $date)
                ->get();

            $gaji_pengurus_pengawas = DB::table('pengurus_pengawas')
                ->join('waktus_pengurus_pengawas', 'waktus_pengurus_pengawas.id', '=', 'pengurus_pengawas.id_waktu')
                ->where(DB::raw("CONCAT(waktus_pengurus_pengawas.bulan, '-', waktus_pengurus_pengawas.tahun)"), $date)
                ->get();
        } else {
            $gaji_karyawan = DB::table('karyawan_' . $kantor)
                ->join('waktus_' . $kantor, 'waktus_' . $kantor . '.id', '=', 'karyawan_' . $kantor . '.id_waktu')
                ->where(DB::raw("CONCAT(waktus_" . $kantor . ".bulan, '-', waktus_" . $kantor . ".tahun)"), $date)
                ->get();

            $gaji_pengurus_pengawas = DB::table('pengurus_pengawas_' . $kantor)
                ->join('waktus_pengurus_pengawas_' . $kantor, 'waktus_pengurus_pengawas_' . $kantor . '.id', '=', 'pengurus_pengawas_' . $kantor . '.id_waktu')
                ->where(DB::raw("CONCAT(waktus_pengurus_pengawas_" . $kantor . ".bulan, '-', waktus_pengurus_pengawas_" . $kantor . ".tahun)"), $date)
                ->get();
        }

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

        // dd($gaji_karyawan, $gaji_pengurus_pengawas, $imageSrc, $kantor, $date);
        $pdf = Pdf::loadView('dashboard.laporan.print', [
            'gaji_karyawan' => $gaji_karyawan,
            'gaji_pengurus_pengawas' => $gaji_pengurus_pengawas,
            'imageSrc' => $imageSrc,
            'kantor' => $kantor,
            'month' => $month,
            'year' => $year
        ])->setPaper('a4', 'portrait');
        if ($kantor == 'pusat') {
            return $pdf->download('Laporan Gaji Karyawan Pusat - ' . $month . '-' . $year . '.pdf');
        } else {
            return $pdf->download('Laporan Gaji Karyawan ' . $kantor . ' ' . $month . '-' . $year . '.pdf');
        }
    }
}
