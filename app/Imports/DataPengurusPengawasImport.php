<?php

namespace App\Imports;

use App\Models\data_pengurus_pengawas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataPengurusPengawasImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $indexKe = 1;
        foreach ($collection as $row) {
            if ($indexKe >= 3) {
                $data['id_karyawan'] = !empty($row[1]) ? $row[1] : 'ID Tidak Ditemukan';
                $data['nama_lengkap'] = !empty($row[2]) ? $row[2] : 'Nama Tidak Ditemukan';
                $data['jabatan'] = !empty($row[3]) ? $row[3] : 'Jabatan Tidak Ditemukan';
                $data['alamat'] = !empty($row[4]) ? $row[4] : 'Alamat Tidak Ditemukan';
                $data['kontak'] = !empty($row[5]) ? $row[5] : '0';
                $data['status'] = 'Aktif';
                data_pengurus_pengawas::create($data);
            }
            $indexKe++;
        }
    }
}
