<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataCabangKaryawanImport implements ToCollection
{
    protected $tableName;
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // dd($this->tableName);
        $indexKe = 1;
        foreach ($collection as $row) {
            if ($indexKe >= 3) {
                 $data['nama_lengkap'] = !empty($row[1]) ? strval($row[1]) : 'Nama Tidak Ditemukan';
                $data['jabatan'] = !empty($row[2]) ? strval($row[2]) : 'Jabatan Tidak Ditemukan';
                $data['alamat'] = !empty($row[3]) ? strval($row[3]) : 'Alamat Tidak Ditemukan';
                $data['kontak'] = !empty($row[4]) ? strval($row[4]) : 'Kontak Tidak Ditemukan';
                $data['status'] = 'Aktif';
                if (Schema::hasTable('data_karyawans_' . $this->tableName)) {
                    // Insert data into the dynamically named table
                    DB::table('data_karyawans_' . $this->tableName)->insert($data);
                } else {
                    \Log::error('Table does not exist: ' . 'data_karyawans_' . $this->tableName);
                }
            }

            $indexKe++;
        }
    }
}
