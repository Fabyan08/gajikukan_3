<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataCabangGajiPengurusPengawasImport implements ToCollection
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
                if ($key > 0 && $key < 23) {
                    $rowData[] = $value;
                    if (!empty($value)) {
                        $emptyRow = false;
                    }
                }
            }
            if (!$emptyRow) {
                $mainCollection->push(new Collection($rowData));
            }
        }

        $indexKe = 1; // Initialize index
        $uploads = []; // Initialize the $uploads array

        foreach ($mainCollection as $item) {
             $user = [
                'id_waktu' => $this->id_waktu,
                'nama' => $item[0] ?? 'Tidak Ditemukan',
                'jabatan' => $item[1] ?? 'Tidak Ditemukan',
                'gaji_pokok' => $item[2] ?? '0',

                'tunjangan_bpjs_kesehatan' => $item[3] ?? '0',
                'tunjangan_bpjs_tk_jp' => $item[4] ?? '0',
                'tunjangan_makan' => $item[5] ?? '0',
                'tunjangan_transport' => $item[6] ?? '0',
                'tunjangan_jabatan' => $item[7] ?? '0',
                'tunjangan_lain_lain' => $item[8] ?? '0',
                'tunjangan_natura' => $item[9] ?? '0',
                'tunjangan_kesehatan' => $item[10] ?? '0',

                'gaji_kotor' => $item[11] ?? '0',

                'potongan_bpjs_tk_kesehatan' => $item[12] ?? '0',
                'potongan_angsuran' => $item[13] ?? '0',
                'potongan_zis' => $item[14] ?? '0',
                'potongan_tabungan_pensiun' => $item[15] ?? '0',

                'total_potongan' => $item[16] ?? '0',

                'gaji_bersih' => $item[17] ?? '0',
            ];

            $indexKe++; // Increment index for the next iteration
            $uploads[] = $user;
        }
        // dd($uploads);
        if (Schema::hasTable('pengurus_pengawas_' . $this->tableName)) {
            DB::table('pengurus_pengawas_' . $this->tableName)->insert($uploads);
        } else {
            \Log::error('Table does not exist: ' . 'pengurus_pengawas_' . $this->tableName);
        }
    }
}
