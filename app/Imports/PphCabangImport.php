<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;

class PphCabangImport implements ToCollection
{
    private $id_waktu; // Property to store the id_waktu value
    private $tableName;

    public function __construct($id_waktu, $tableName)
    {
        $this->id_waktu = $id_waktu;

        $this->tableName = $tableName;
    }

    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {
        $dataRows = $collection->slice(4);

        $mainCollection = new Collection();

        // Process each row of data
        foreach ($dataRows as $row) {
            $rowData = [];
            $emptyRow = true;
            foreach ($row as $key => $value) {
                if ($key > 0 && $key < 15) {
                    $rowData[] = $value;
                    if (!empty($value)) {
                        $emptyRow = false;
                    }
                }
            }
            if ($emptyRow) {
                break; // Exit the loop if the row is empty
            }
            $mainCollection->push(new Collection($rowData));
        }


        $indexKe = 1; // Initialize index
        $uploads = []; // Initialize the $uploads array

        foreach ($mainCollection as $item) {
            $user = [
                'id_waktu' => $this->id_waktu,
                'nama_pegawai' => $item[0] ?? 'Tidak Ditemukan',
                'status' => $item[1] ?? 'Tidak Ditemukan',
                'penghasilan_bruto_bulan' => $item[2] ?? '0',
                'penghasilan_disetahunkan' => $item[3] ?? '0',
                'bonus' => $item[4] ?? '0',
                'thr' => $item[5] ?? '0',
                'penghasilan_bruto' => $item[6] ?? '0',
                'pengurangan_biaya_jabatan' => $item[7] ?? '0',
                'jumlah_penghasilan_neto_setahun' => $item[8] ?? '0',
                'ptkp' => $item[9] ?? '0',
                'ptkp_disetahunkan' => $item[10] ?? '0',
                'pph_21' => $item[11] ?? '0',
                'iuran_per_bulan' => $item[12] ?? '0',
            ];

            // dd($user);

            $indexKe++; // Increment index for the next iteration
            $uploads[] = $user;
        }
        if (Schema::hasTable('pph_' . $this->tableName)) {
            DB::table('pph_' . $this->tableName)->insert($uploads);
        } else {
            \Log::error('Table does not exist: ' . 'pph_' . $this->tableName);
        }
    }
}
