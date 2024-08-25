<?php

namespace App\Imports;

use App\Models\Karyawan;
use App\Models\Upload;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GajiImport implements ToCollection
{
    private $id_waktu; // Property to store the id_waktu value

    public function __construct($id_waktu)
    {
        $this->id_waktu = $id_waktu;
    }

    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {
        // MANTAP BANGETT3
        $dataRows = $collection->slice(4);

        $mainCollection = new Collection();

        // Process each row of data
        foreach ($dataRows as $row) {
            $rowData = [];
            $emptyRow = true;
            foreach ($row as $key => $value) {
                if ($key > 0 && $key < 24) {
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
                'nama' => $item[0] ?? 'Tidak Ditemukan',
                'jabatan' => $item[1] ?? 'Tidak Ditemukan',
                'gaji_pokok' => $item[2] ?? '0',
                'tunjangan_makan' => $item[3] ?? '0',
                'tunjangan_transport' => $item[4] ?? '0',
                'tunjangan_senja' => $item[5] ?? '0',
                'tunjangan_hadir' => $item[6] ?? '0',
                'tunjangan_jabatan' => $item[7] ?? '0',
                'tunjangan_komunikasi' => $item[8] ?? '0',
                'tunjangan_natura' => $item[9] ?? '0',
                'reward_lending' => $item[10] ?? '0',
                'reward_funding' => $item[11] ?? '0',
                'bpjs_tk' => $item[12] ?? '0',
                'bpjs_kesehatan' => $item[13] ?? '0',
                'gaji_kotor' => $item[14] ?? '0',
                'potongan_bpjs_tk_kesehatan' => $item[15] ?? '0',
                'potongan_angsuran' => $item[16] ?? '0',
                'potongan_ijin' => $item[17] ?? '0',
                'potongan_zis' => $item[19] ?? '0',
                'potongan_pensiun' => $item[20] ?? '0',
                'total_potongan' => $item[21] ?? '0',
                'gaji_bersih' => $item[22] ?? '0',
            ];
            
            // dd($user);

            $indexKe++; // Increment index for the next iteration
            $uploads[] = $user;
        }
        // dd($uploads);
        Karyawan::insert($uploads);
    }
}
