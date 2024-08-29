<?php

namespace App\Http\Controllers;

use App\Imports\PphCabangImport;
use App\Imports\PphImport;
use App\Models\Pph;
use App\Models\WaktuPph;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class PphController extends Controller
{
    public function index(Request $request)
    {

        $tables = DB::select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                if (strpos($value, 'pph_') === 0 || strpos($value, 'waktu_pph_') === 0) {
                    // Remove the prefixes to get only the suffix
                    $suffix = preg_replace('/^(pph_|waktu_pph_)/', '', $value);
                    $tableList[] = strtoupper($suffix);
                }
            }
        }

        // Remove duplicate suffixes
        $tableList = array_unique($tableList);

        return view('dashboard.pph.index', compact('tableList'));
    }

    public function tambah_kantor(Request $request)
    {
        $request->validate([
            'nama_tabel' => ['required', 'string', 'regex:/^[a-z_]+$/'], // Only lowercase and underscores allowed
        ]);
        // dd($request->all());
        $tableName = $request->input('nama_tabel');
        Schema::create('pph_' . $tableName, function ($table) {
            $table->id();
            $table->string('id_waktu');
            $table->string('nama_pegawai');
            $table->string('status');
            $table->string('penghasilan_bruto_bulan');
            $table->string('penghasilan_disetahunkan');
            $table->string('bonus');
            $table->string('thr');
            $table->string('penghasilan_bruto');
            $table->string('pengurangan_biaya_jabatan');
            $table->string('jumlah_penghasilan_neto_setahun');
            $table->string('ptkp');
            $table->string('ptkp_disetahunkan');
            $table->string('pph_21');
            $table->string('iuran_per_bulan');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('waktu_pph_' . $tableName, function ($table) {
            $table->id();
            $table->date('tanggal');
            $table->string('bulan');
            $table->string('tahun');
            $table->timestamps();
        });

        return redirect()->back()->with('success', 'Kantor created successfully');
    }

    public function hapus_kantor(Request $reques)
    {
        $nama_tabel = request('table_name');
        Schema::dropIfExists('pph_' . $nama_tabel);
        Schema::dropIfExists('waktu_pph_' . $nama_tabel);
        return redirect()->back()->with('success', 'Kantor deleted successfully');
    }

    public function detail_pusat()
    {
        $pph = Pph::all();
        $currentYear = date('Y');
        $startYear = $currentYear - 2;
        $endYear = $currentYear + 2;
        $years = range($startYear, $endYear);

        $data_waktu = WaktuPph::all()->sortByDesc('id');
        return view('dashboard.pph.pusat', compact('pph', 'years', 'data_waktu'));
    }

    public function store_waktu_pusat(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        WaktuPph::create([
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        return redirect()->back()->with('success', 'Data Waktu Berhasil Ditambahkan, Yuk Upload Slip Gaji CSV');
    }

    public function delete_waktu_pusat($id)
    {
        $waktu = WaktuPph::find($id);


        if (!$waktu) {
            return redirect()->back()->with('error', 'Data Waktu Tidak Ditemukan');
        }


        // Check if the 'id_waktu' exists in the 'pph' table
        $existsInPph = DB::table('pph')->where('id_waktu', $id)->exists();

        if ($existsInPph) {
            // If it exists, don't delete and return with a warning
            $waktu->delete();
        }
        // If 'id_waktu' does not exist in the 'pph' table, proceed with deletion

        $delete_waktu_pph = WaktuPph::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Waktu Berhasil Dihapus');
    }

    public function index_pusat($id_waktu)
    {
        $waktu = WaktuPph::find($id_waktu);
        $pph = Pph::where('id_waktu', $id_waktu)->get();
        return view('dashboard.pph.detail_pusat', compact('waktu', 'pph'));
    }

    public function store_pusat(Request $request, $id_waktu)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx,txt', // Added max size validation
        ]);


        $file = $request->file('file');
        Excel::import(new PphImport($id_waktu), $request->file('file'));

        return redirect()->back()->with('success', 'Data PPH Berhasil Ditambahkan');
    }

    public function waktu_detail_pusat($id, $id_waktu)
    {
        $pph = DB::table('pph')
            ->join('waktu_pph', 'waktu_pph.id', '=', 'pph.id_waktu')
            ->where('waktu_pph.id', $id)
            ->where('pph.id', $id_waktu)
            ->select('pph.*', 'waktu_pph.*', 'waktu_pph.id as id_waktu', 'pph.id as id_pph')
            ->first();


        return view('dashboard.pph.waktu_detail_pusat', compact('pph'));
    }

    public function update_waktu_detail_pusat(Request $request, $id, $id_waktu)
    {

        $request->validate([
            'nama_pegawai' => 'required',
            'status' => 'required',
            'penghasilan_bruto_bulan' => 'required',
            'penghasilan_disetahunkan' => 'required',
            'bonus' => 'required',
            'thr' => 'required',
            'penghasilan_bruto' => 'required',
            'pengurangan_biaya_jabatan' => 'required',
            'jumlah_penghasilan_neto_setahun' => 'required',
            'ptkp' => 'required',
            'ptkp_disetahunkan' => 'required',
            'pph_21' => 'required',
            'iuran_per_bulan' => 'required',
        ]);

        $pph = Pph::find($id_waktu);

        if (!$pph) {
            return redirect()->back()->with('error', 'Data PPH Tidak Ditemukan');
        } else {

            $pph->update([
                'id_waktu' => $id_waktu,
                'nama_pegawai' => $request->nama_pegawai,
                'status' => $request->status,
                'penghasilan_bruto_bulan' => $request->penghasilan_bruto_bulan,
                'penghasilan_disetahunkan' => $request->penghasilan_disetahunkan,
                'bonus' => $request->bonus,
                'thr' => $request->thr,
                'pengurangan_biaya_jabatan' => $request->pengurangan_biaya_jabatan,
                'ptkp' => $request->ptkp,
                'ptkp_disetahunkan' => $request->ptkp_disetahunkan,
                'pph_21' => $request->pph_21,
                'iuran_per_bulan' => $request->iuran_per_bulan,
            ]);
        }

        return redirect()->back()->with('success', 'Data PPH Berhasil Di-update!');
    }

    public function delete_all_pusat(Request $request, $id_waktu)
    {

        $pph = Pph::where('id_waktu', $id_waktu)->delete();

        return redirect()->back()->with('success', 'Data PPH Berhasil Dihapus');
    }

    public function print_pusat($id_waktu)
    {
        $pph = DB::table('pph')->where('id_waktu', $id_waktu)
            ->join('waktu_pph', 'waktu_pph.id', '=', 'pph.id_waktu')
            ->select('pph.*', 'waktu_pph.*', 'waktu_pph.id as id_waktu', 'pph.id as id_pph')
            ->get();
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

        $pdf = Pdf::loadView('dashboard.pph.print', [
            'pph' => $pph,
            'imageSrc' => $imageSrc,
        ])->setPaper('a4', 'landscape'); // Pass $gaji as an array to the view

        return $pdf->download('Data PPH 21-' . $pph[0]->bulan . '-' . $pph[0]->tahun . '.pdf');
    }

    // Kantor Cabang


    public function index_cabang($slug)
    {
        // Construct table names dynamically
        $pphTable = 'pph_' . $slug;
        $waktuTable = 'waktu_pph_' . $slug;

        // Check if tables exist
        if (!Schema::hasTable($pphTable) || !Schema::hasTable($waktuTable)) {
            return redirect()->back()->withErrors(['error' => 'Table not found.']);
        }

        // Retrieve data from the pph table
        $pph = DB::table($pphTable)->get();

        // Get the current year and range of years for dropdown
        $currentYear = date('Y');
        $startYear = $currentYear - 2;
        $endYear = $currentYear + 2;
        $years = range($startYear, $endYear);

        // Retrieve and sort data from the waktu_pph table
        $data_waktu = DB::table($waktuTable)->orderBy('id', 'desc')->get();

        $kantor = strtolower($slug);

        return view('dashboard.pph.cabang.index', compact('pph', 'years', 'data_waktu', 'kantor'));
    }

    public function store_waktu_cabang(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
            'tahun' => 'required|string',
            'tanggal' => 'required|date', // Ensu
        ]);

        DB::table('waktu_pph_' . $request->slug)->insert([
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        return redirect()->back()->with('success', 'Data Waktu Berhasil Ditambahkan, Yuk Upload Slip Gaji CSV');
    }
    public function delete_waktu_cabang($id, $slug)
    {
        $waktu = DB::table('waktu_pph_' . $id);
        // dd($waktu, $id, $slug);

        if (!$waktu) {
            return redirect()->back()->with('error', 'Data Waktu Tidak Ditemukan');
        }
        // Check if the 'id_waktu' exists in the 'pph' table
        $existsInPph = DB::table('pph_' . $id)->where('id_waktu', $id)->exists();

        if ($existsInPph) {
            // If it exists, don't delete and return with a warning
            $waktu->delete();
        }
        // If 'id_waktu' does not exist in the 'pph' table, proceed with deletion

        $delete_waktu_pph = DB::table('waktu_pph_' . $id)->where('id', $slug)->delete();

        return redirect()->back()->with('success', 'Data Waktu Berhasil Dihapus');
    }

    public function detail_cabang($slug, $id_waktu)
    {
        $kantor = strtolower($slug);
        $waktu = DB::table('waktu_pph_' . $slug)->find($id_waktu);
        $pph = DB::table('pph_' . $slug)->where('id_waktu', $id_waktu)->get();
        return view('dashboard.pph.cabang.waktu_detail', compact('waktu', 'pph', 'kantor'));
    }

    public function store_cabang(Request $request, $id_waktu, $tableName)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,xls,xlsx,txt', // Added max size validation
        ]);

        $file = $request->file('file');
        FacadesExcel::import(new PphCabangImport($id_waktu, $tableName), $request->file('file'));

        return redirect()->back()->with('success', 'Data PPH Berhasil Ditambahkan');
    }

    public function detail_data_cabang($slug, $id, $id_waktu)
    {
        // Convert slug to lowercase to ensure consistency
        $slug = strtolower($slug);

        // Define dynamic table names
        $pphTable = 'pph_' . $slug;
        $waktuTable = 'waktu_pph_' . $slug;

        // Check if tables exist (Optional, but recommended)
        if (!Schema::hasTable($pphTable) || !Schema::hasTable($waktuTable)) {
            return redirect()->back()->withErrors(['error' => 'Table not found.']);
        }

        // Fetch the data with the dynamic table names
        $pph = DB::table($pphTable)
            ->join($waktuTable, $waktuTable . '.id', '=', $pphTable . '.id_waktu')
            ->where($waktuTable . '.id', $id)
            ->where($pphTable . '.id', $id_waktu)
            ->select(
                $pphTable . '.*',
                $waktuTable . '.*',
                $waktuTable . '.id as id_waktu',
                $pphTable . '.id as id_pph'
            )
            ->first();

        $kantor = strtolower($slug);

        // Return the view with the fetched data
        return view('dashboard.pph.cabang.detail_data', compact('pph', 'kantor'));
    }

    public function update_detail_data_cabang(Request $request, $slug, $id, $id_waktu)
    {
        // Convert slug to lowercase to ensure consistency
        $slug = strtolower($slug);

        // Define the dynamic table name
        $pphTable = 'pph_' . $slug;

        // Validate the incoming request data
        $request->validate([
            'nama_pegawai' => 'required',
            'status' => 'required',
            'penghasilan_bruto_bulan' => 'required',
            'penghasilan_disetahunkan' => 'required',
            'bonus' => 'required',
            'thr' => 'required',
            'penghasilan_bruto' => 'required',
            'pengurangan_biaya_jabatan' => 'required',
            'jumlah_penghasilan_neto_setahun' => 'required',
            'ptkp' => 'required',
            'ptkp_disetahunkan' => 'required',
            'pph_21' => 'required',
            'iuran_per_bulan' => 'required',
        ]);

        // Retrieve the record from the dynamic table
        $pph = DB::table($pphTable)->where('id', $id_waktu)->first();

        if (!$pph) {
            // Redirect back with an error if the record is not found
            return redirect()->back()->with('error', 'Data PPH Tidak Ditemukan');
        }

        // Update the record using the Query Builder
        DB::table($pphTable)->where('id', $id_waktu)->update([
            'nama_pegawai' => $request->nama_pegawai,
            'status' => $request->status,
            'penghasilan_bruto_bulan' => $request->penghasilan_bruto_bulan,
            'penghasilan_disetahunkan' => $request->penghasilan_disetahunkan,
            'bonus' => $request->bonus,
            'thr' => $request->thr,
            'penghasilan_bruto' => $request->penghasilan_bruto,
            'pengurangan_biaya_jabatan' => $request->pengurangan_biaya_jabatan,
            'jumlah_penghasilan_neto_setahun' => $request->jumlah_penghasilan_neto_setahun,
            'ptkp' => $request->ptkp,
            'ptkp_disetahunkan' => $request->ptkp_disetahunkan,
            'pph_21' => $request->pph_21,
            'iuran_per_bulan' => $request->iuran_per_bulan,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data PPH Berhasil Di-update!');
    }

    public function delete_all_cabang(Request $request, $id_waktu, $slug)
    {
        $pph = DB::table('pph_' . $id_waktu)->where('id_waktu', $slug)->delete();

        return redirect()->back()->with('success', 'Data PPH Berhasil Dihapus');
    }

    public function print_cabang($id_waktu, $kantor)
    {
        $pph = DB::table('pph_' . $kantor)->where('id_waktu', $id_waktu)
            ->join('waktu_pph_' . $kantor, 'waktu_pph_' . $kantor . '.id', '=', 'pph_' . $kantor . '.id_waktu')
            ->select('pph_' . $kantor . '.*', 'waktu_pph_' . $kantor . '.*', 'waktu_pph_' . $kantor . '.id as id_waktu', 'pph_' . $kantor . '.id as id_pph')
            ->get();
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

        $slug = $kantor;

        $pdf = Pdf::loadView('dashboard.pph.cabang.print', [
            'kantor ' => $kantor,
            'slug' => $slug,
            'pph' => $pph,
            'imageSrc' => $imageSrc,
        ])->setPaper('a4', 'landscape'); // Pass $gaji as an array to the view

        return $pdf->download('Data PPH 21 ' . $kantor . '-' . $pph[0]->bulan . '-' . $pph[0]->tahun . '.pdf');
    }
}
