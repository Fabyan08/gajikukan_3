<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KaryawanImport implements ToCollection
{
    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {
        $dataRows = $collection->slice(4); // Skip the first two rows (title and header)

        $mainCollection = new Collection();
        dd(1);

        // Process each row of data
        foreach ($dataRows as $row) {
            $rowData = [];
            $emptyRow = true;
            foreach ($row as $key => $value) {
                // Exclude the first column (index 0) which contains numbers
                if ($key > 0 && $key < 4) {
                    $rowData[] = $value;
                    if (!empty($value)) {
                        $emptyRow = false;
                    }
                }
            }
            // If the row is not empty, add it to the main collection
            if (!$emptyRow) {
                $mainCollection->push(new Collection($rowData));
            }
        }
        // dd($mainCollection); // Debugging to check the contents of $mainCollection

        $indexKe = 1; // Initialize index

        foreach ($mainCollection as $item) {
            $user = [
                'nama' => $item[0] ?? 'Tidak Ditemukan',
                'jabatan' => $item[1] ?? 'Tidak Ditemukan',
                'gaji' => $item[2] ?? 'Tidak Ditemukan',
                'email' => 'nonaktif' . $indexKe . '@koperasi.com', // Concatenate index with email
                'password' => bcrypt('123456'),
                'level' => 'karyawan',
                'status' => 'not active',
            ];

            $indexKe++; // Increment index for the next iteration
            $users[] = $user;
        }
        dd($users);

        User::insert($users);
    }
}
