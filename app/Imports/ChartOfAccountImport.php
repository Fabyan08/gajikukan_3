<?php

namespace App\Imports;

use App\Models\ChartOfAccount;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChartofAccountImport implements ToCollection
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
                $data['nama'] = !empty($row[2]) ? $row[2] : 'Nama Tidak Ditemukan';
                $data['jenis_kelamin'] = !empty($row[3]) ? $row[3] : 'Jenis Kelamin Tidak Ditemukan';
                $data['jabatan'] = !empty($row[4]) ? $row[4] : 'Jabatan Tidak Ditemukan';
                $data['divisi'] = !empty($row[5]) ? $row[5] : 'Divisi Tidak Ditemukan';
                $data['masa_kerja'] = !empty($row[6]) ? $row[6] : 'Masa Kerja Tidak Ditemukan';
                $data['status_karyawan'] = !empty($row[7]) ? $row[7] : 'Status Karyawan Tidak Ditemukan';
                $data['alamat'] = !empty($row[8]) ? $row[8] : 'Alamat Tidak Ditemukan';
                $data['npwp'] = !empty($row[9]) ? $row[9] : 'NPWP Tidak Ditemukan';
                $data['email'] = !empty($row[10]) ? $row[10] : 'Email Tidak Ditemukan';

                ChartOfAccount::create($data);
            }

            $indexKe++;
        }
    }
}
