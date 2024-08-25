<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        dd($collection);
        $indexKe = 1;
        foreach ($collection as $row) {
            if ($indexKe > 1) {

                $data['nama'] = !empty($row[0]) ? $row[0] : 'Nama Tidak Ditemukan';
                $data['jabatan'] = !empty($row[1]) ? $row[1] : 'Nama Tidak Ditemukan';
                $data['gaji'] = !empty($row[2]) ? $row[2] : 'Nama Tidak Ditemukan';

                User::create($data);
            }
            $indexKe++;
        }
    }
}
