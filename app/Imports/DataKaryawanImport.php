<?php

namespace App\Imports;

use App\Models\data_karyawans;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataKaryawanImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $indexKe = 1;
        foreach ($collection as $row) {
            if ($indexKe >= 3) {
                $data['nama_lengkap'] = !empty($row[1]) ? strval($row[1]) : 'Nama Tidak Ditemukan';
                $data['jabatan'] = !empty($row[2]) ? strval($row[2]) : 'Jabatan Tidak Ditemukan';
                $data['alamat'] = !empty($row[3]) ? strval($row[3]) : 'Alamat Tidak Ditemukan';
                $data['kontak'] = !empty($row[4]) ? strval($row[4]) : 'Kontak Tidak Ditemukan';
                $data['status'] = 'Aktif';

                data_karyawans::create($data);
            }
            $indexKe++;
        }
    }
}
