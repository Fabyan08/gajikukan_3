<?php

namespace App\Http\Controllers;

use App\Charts\GajiChart;
use App\Models\ImportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(GajiChart $chart)
    {

$total_gaji_sebelum  = 0;
$pengurus_pengawas_cabang = 0;
        $bulan_terakhir = DB::table('waktus')->orderBy('id', 'desc')->value('bulan');
        $bln = DB::table('waktus')->orderBy('id', 'desc')->first(['bulan', 'tahun']);;

        // Initialize total salaries and results array
        $total_gaji_semuanya = 0;
        $results = [];

        if ($bln) {
            // Calculate total salary for 'main' branch
            $last_id_waktu_karyawan = DB::table('karyawans')
                ->join('waktus', 'waktus.id', 'karyawans.id_waktu')
                ->where('waktus.bulan', $bln->bulan)
                ->where('waktus.tahun', $bln->tahun)
                ->first();

        $last_id_waktu_pengurus = DB::table('pengurus_pengawas')->orderBy('id_waktu', 'desc')->first();

        $sum_gaji_pokok_karyawan = 0;
        $sum_gaji_pokok_pengurus = 0;


        if ($last_id_waktu_karyawan) {
            $sum_gaji_pokok_karyawan = DB::table('karyawans')
                ->join('waktus', 'waktus.id', 'karyawans.id_waktu')
                ->where('waktus.bulan', $bln->bulan)
                ->where('waktus.tahun', $bln->tahun)
                ->sum('gaji_bersih');
        }


        if ($last_id_waktu_pengurus) {
            $sum_gaji_pokok_pengurus = DB::table('pengurus_pengawas')
                ->join('waktus_pengurus_pengawas', 'waktus_pengurus_pengawas.id', 'pengurus_pengawas.id_waktu')
                ->where('waktus_pengurus_pengawas.bulan', $bln->bulan)
                ->where('waktus_pengurus_pengawas.tahun', $bln->tahun)
                ->sum('gaji_bersih');
        }

        $total_gaji_main = $sum_gaji_pokok_karyawan + $sum_gaji_pokok_pengurus;

        // Add 'main' branch total to results and overall total
        $total_gaji_semuanya += $total_gaji_main;
        }



        // Get all table names
        $tables = DB::select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                // Filter tables by relevant prefixes
                if (strpos($value, 'karyawan_') === 0 || strpos($value, 'pengurus_pengawas_') === 0 || strpos($value, 'data_karyawans_') === 0 || strpos($value, 'data_pengurus_pengawas_') === 0) {
                    // Remove the prefixes to get only the suffix
                    $suffix = preg_replace('/^(karyawan_|pengurus_pengawas_|data_karyawans_|data_pengurus_pengawas_)/', '', $value);
                    $tableList[$suffix] = $value; // Store the full table name with suffix as key
                }
            }
        }

        // Remove duplicate suffixes
        $kantor_cabang = array_unique(array_keys($tableList));

if($bln){
        foreach ($kantor_cabang as $branch) {
            $karyawan_table = "karyawan_" . $branch;
            $pengurus_table = "pengurus_pengawas_" . $branch;

            $last_id_waktu_karyawan = DB::table($karyawan_table)->orderBy('id_waktu', 'desc')->first();
            $last_id_waktu_pengurus = DB::table($pengurus_table)->orderBy('id_waktu', 'desc')->first();

            $sum_gaji_pokok_karyawan = 0;
            $sum_gaji_pokok_pengurus = 0;

            if ($last_id_waktu_karyawan) {
                $sum_gaji_pokok_karyawan = DB::table($karyawan_table)
                    ->join('waktus_' . $branch, 'waktus_' . $branch . '.id', 'karyawan' . '_' . $branch . '.id_waktu')
                    ->where('waktus_' . $branch . '.bulan', $bln->bulan)
                    ->where('waktus_' . $branch . '.tahun', $bln->tahun)
                    ->sum('gaji_bersih');
            }

            if ($last_id_waktu_pengurus) {
                $sum_gaji_pokok_pengurus = DB::table($pengurus_table)
                    ->join('waktus_pengurus_pengawas_' . $branch, 'waktus_pengurus_pengawas_' . $branch . '.id', 'pengurus_pengawas' . '_' . $branch . '.id_waktu')
                    ->where('waktus_pengurus_pengawas_' . $branch . '.bulan', $bln->bulan)
                    ->where('waktus_pengurus_pengawas_' . $branch . '.tahun', $bln->tahun)
                    ->sum('gaji_bersih');
            }

            // dump($sum_gaji_pokok_karyawan, $sum_gaji_pokok_pengurus); // This will display the output but continue the loop

            $total_gaji_branch = $sum_gaji_pokok_karyawan + $sum_gaji_pokok_pengurus;

            // Add branch result to the results array and overall total
            $total_gaji_semuanya += $total_gaji_branch;
        }
        // DUA BULAn AKHIR

        $total_gaji_semuanya_sebelum = 0;
        $results = [];
        // Kantor Pusat
        $dua_bulan_terakhir = DB::table('waktus')
            ->orderBy('id', 'desc')
            ->skip(1)
            ->first(['bulan', 'tahun']);

      
            if ($dua_bulan_terakhir != null) {
                $sum_gaji_pokok_karyawan_sebelum = DB::table('karyawans')
                    ->join('waktus', 'waktus.id', 'karyawans.id_waktu')
                    ->where('bulan', $dua_bulan_terakhir->bulan)
                    ->where('tahun', $dua_bulan_terakhir->tahun)
                    ->sum('gaji_bersih');


                $sum_gaji_pokok_pengurus_sebelum = DB::table('pengurus_pengawas')
                    ->join('waktus_pengurus_pengawas', 'waktus_pengurus_pengawas.id', 'pengurus_pengawas.id_waktu')
                    ->where('bulan', $dua_bulan_terakhir->bulan)
                    ->where('tahun', $dua_bulan_terakhir->tahun)
                    ->sum('gaji_bersih');


                $total_gaji_sebelum = $sum_gaji_pokok_karyawan_sebelum + $sum_gaji_pokok_pengurus_sebelum;
            } else {
                $total_gaji_sebelum = 0;
            }


        $total_gaji_semuanya_sebelum += $total_gaji_sebelum;
}



        // Kantor Batu
     $dua_bulan_terakhir = DB::table('waktus')
            ->orderBy('id', 'desc')
            ->skip(1)
            ->first(['bulan', 'tahun']);
        // COBA GAJI SEBELUMNYA
        // Get all table names
        $tables = DB::select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                // Filter tables by relevant prefixes
                if (strpos($value, 'karyawan_') === 0 || strpos($value, 'pengurus_pengawas_') === 0 || strpos($value, 'data_karyawans_') === 0 || strpos($value, 'data_pengurus_pengawas_') === 0) {
                    // Remove the prefixes to get only the suffix
                    $suffix = preg_replace('/^(karyawan_|pengurus_pengawas_|data_karyawans_|data_pengurus_pengawas_)/', '', $value);
                    $tableList[$suffix] = $value; // Store the full table name with suffix as key
                }
            }
        }

        // Remove duplicate suffixes
        $kantor_cabang = array_unique(array_keys($tableList));

        if ($dua_bulan_terakhir != null) {
            foreach ($kantor_cabang as $branch) {
                $karyawan_table = "karyawan_" . $branch;
                $pengurus_table = "pengurus_pengawas_" . $branch;

                $last_id_waktu_karyawan_sebelum = DB::table($karyawan_table)->orderBy('id_waktu', 'desc')->skip(1)->first();
                $last_id_waktu_pengurus_sebelum = DB::table($pengurus_table)->orderBy('id_waktu', 'desc')->skip(1)->first();

                $sum_gaji_pokok_karyawan_sebelum = 0;
                $sum_gaji_pokok_pengurus_sebelum = 0;

                if ($last_id_waktu_karyawan_sebelum) {
                    $sum_gaji_pokok_karyawan_sebelum = DB::table($karyawan_table)
                        ->join('waktus_' . $branch, 'waktus_' . $branch . '.id', 'karyawan' . '_' . $branch . '.id_waktu')
                        ->where('waktus_' . $branch . '.bulan', $dua_bulan_terakhir->bulan)
                        ->where('waktus_' . $branch . '.tahun', $dua_bulan_terakhir->tahun)
                        ->sum('gaji_bersih');
                }

                if ($last_id_waktu_pengurus_sebelum) {
                    $sum_gaji_pokok_pengurus_sebelum = DB::table($pengurus_table)
                        ->join('waktus_pengurus_pengawas_' . $branch, 'waktus_pengurus_pengawas_' . $branch . '.id', 'pengurus_pengawas' . '_' . $branch . '.id_waktu')
                        ->where('waktus_pengurus_pengawas_' . $branch . '.bulan', $dua_bulan_terakhir->bulan)
                        ->where('waktus_pengurus_pengawas_' . $branch . '.tahun', $dua_bulan_terakhir->tahun)
                        ->sum('gaji_bersih');
                }

                $total_gaji_branch = $sum_gaji_pokok_karyawan_sebelum + $sum_gaji_pokok_pengurus_sebelum;

                $total_gaji_sebelum += $total_gaji_branch;
            }
        }


        $total_semua_karyawan = 0;

        // Calculate the total for the central branch
        $total_karyawan = DB::table('data_karyawans')->where('status', 'Aktif')->count();
        $total_pengurus = DB::table('data_pengurus_pengawas')->where('status', 'Aktif')->count();
        $total_karyawan_pusat = $total_karyawan + $total_pengurus;



        // Add the central branch total to the overall total
        $total_semua_karyawan += $total_karyawan_pusat;

        foreach ($kantor_cabang as $branch) {
            $karyawan_table = "data_karyawans_" . $branch;
            $pengurus_table = "data_pengurus_pengawas_" . $branch;

            $karyawan_cabang = DB::table($karyawan_table)->where('status', 'Aktif')->count();
            $pengurus_cabang = DB::table($pengurus_table)->where('status', 'Aktif')->count();

            $count_karyawan_cabang = 0;
            $count_pengurus_cabang = 0;

            if ($karyawan_cabang) {
                $count_karyawan_cabang = DB::table($karyawan_table)
                    ->count();
            }

            if ($pengurus_cabang) {
                $count_pengurus_cabang = DB::table($pengurus_table)
                    ->count();
            }
            $total_cabang = $count_karyawan_cabang + $count_pengurus_cabang;

            // Add the branch total to the overall total
            $total_semua_karyawan += $total_cabang;
        }

        // Now, $total_semua_karyawan includes both central and branch totals
        $jumlah_semua_karyawan_pusat_cabang = $total_semua_karyawan;


        // Chart
        $chart = $chart->build();



        // get data karyawan
        $tableName = request('kantor_cabang');

        $jumlah_tunjangan_karyawan = 0;
        $jumlah_reward_karyawan = 0;
        $jumlah_bpjs_karyawan = 0;
        $jumlah_potongan_karyawan = 0;
        $waktu_karyawan = null;
        $total_karyawan_cabang = 0;

        $jumlah_tunjangan_pengurus_pengawas = 0;
        $jumlah_potongan_pengurus_pengawas = 0;
        $waktus_pengurus_pengawas = null;
        // Check if the table exists
        if ($tableName) {
            if (!Schema::hasTable('data_karyawans_' . $tableName)) {
                abort(404, 'Table not found');
            }
            // Fetch data from the table
            $last_id_waktu_karyawan_cabang = DB::table('karyawan_' . $tableName)->orderBy('id_waktu', 'desc')->first();
            if ($last_id_waktu_karyawan_cabang != null) {
                $waktu_karyawan = DB::table('waktus_' . $tableName)->where('id', $last_id_waktu_karyawan_cabang->id_waktu)->first();
            }
            if ($last_id_waktu_karyawan_cabang != null) {
                // Tunjangan
                $columns = [
                    'tunjangan_makan',
                    'tunjangan_transport',
                    'tunjangan_senja',
                    'tunjangan_jabatan',
                    'tunjangan_komunikasi',
                    'tunjangan_natura',
                    'reward_lending',
                    'reward_funding',
                    'bpjs_tk',
                    'bpjs_kesehatan',
                    'potongan_bpjs_tk_kesehatan',
                    'potongan_angsuran',
                    'potongan_ijin',
                    'potongan_zis',
                    'potongan_pensiun',
                    'gaji_bersih'
                ];

                $sums = [];

                foreach ($columns as $column) {
                    $sums[$column] = DB::table('karyawan_' . $tableName)
                        ->where('id_waktu', $last_id_waktu_karyawan_cabang->id_waktu)
                        ->sum($column);
                }
                // Gaji Bersih
                $gaji_bersih_karyawan = $sums['gaji_bersih'];

                $tunjangan_makan_karyawan = $sums['tunjangan_makan'];
                $tunjangan_transport_karyawan = $sums['tunjangan_transport'];
                $tunjangan_senja_karyawan = $sums['tunjangan_senja'];
                $tunjangan_jabatan_karyawan = $sums['tunjangan_jabatan'];
                $tunjangan_komunikasi_karyawan = $sums['tunjangan_komunikasi'];
                $tunjangan_natura_karyawan = $sums['tunjangan_natura'];

                $jumlah_tunjangan_karyawan = $tunjangan_makan_karyawan + $tunjangan_transport_karyawan + $tunjangan_senja_karyawan + $tunjangan_jabatan_karyawan + $tunjangan_komunikasi_karyawan + $tunjangan_natura_karyawan;

                // Reward
                $reward_lending_karyawan = $sums['reward_lending'];
                $reward_funding_karyawan = $sums['reward_funding'];

                $jumlah_reward_karyawan = $reward_lending_karyawan + $reward_funding_karyawan;

                // BPJS
                $bpjs_tk_karyawan = $sums['bpjs_tk'];
                $bpjs_kesehatan_karyawan = $sums['bpjs_kesehatan'];

                $jumlah_bpjs_karyawan = $bpjs_tk_karyawan + $bpjs_kesehatan_karyawan;

                // Potongan
                $potongan_bpjs_tk_kesehatan_karyawan = $sums['potongan_bpjs_tk_kesehatan'];
                $potongan_angsuran_karyawan = $sums['potongan_angsuran'];
                $potongan_ijin_karyawan = $sums['potongan_ijin'];
                $potongan_zis_karyawan = $sums['potongan_zis'];
                $potongan_pensiun_karyawan = $sums['potongan_pensiun'];

                $jumlah_potongan_karyawan = $potongan_bpjs_tk_kesehatan_karyawan + $potongan_angsuran_karyawan + $potongan_ijin_karyawan + $potongan_zis_karyawan + $potongan_pensiun_karyawan;

                // Jumlah karyawan
                $total_karyawan_cabang = DB::table('data_karyawans_' . $tableName)->count();
                $total_pengurus_cabang = DB::table('data_pengurus_pengawas_' . $tableName)->count();

                $total_karyawan_cabang = $total_karyawan_cabang + $total_pengurus_cabang;
                $karyawan_cabang = DB::table('data_karyawans_' . $tableName)->count();
            } else {
                $gaji_bersih_karyawan = 0;
                $jumlah_tunjangan_karyawan = 0;
                $jumlah_reward_karyawan = 0;
                $jumlah_bpjs_karyawan = 0;
                $jumlah_potongan_karyawan = 0;
                $total_karyawan_cabang = 0;
            }

            // Pengurus Pengawas
            if (!Schema::hasTable('data_pengurus_pengawas_' . $tableName)) {
                abort(404, 'Table not found');
            }
            $last_id_waktu_pengurus_pengawas_cabang = DB::table('pengurus_pengawas_' . $tableName)->orderBy('id_waktu', 'desc')->first();
            if ($last_id_waktu_pengurus_pengawas_cabang != null) {
                $waktus_pengurus_pengawas = DB::table('waktus_pengurus_pengawas_' . $tableName)->where('id', $last_id_waktu_pengurus_pengawas_cabang->id_waktu)->first();
            }
            if ($last_id_waktu_pengurus_pengawas_cabang != null) {
                $columns = [
                    'tunjangan_bpjs_kesehatan',
                    'tunjangan_bpjs_tk_jp',
                    'tunjangan_transport',
                    'tunjangan_makan',
                    'tunjangan_jabatan',
                    'tunjangan_lain_lain',
                    'tunjangan_natura',
                    'tunjangan_kesehatan',
                    // Potongan
                    'potongan_bpjs_tk_kesehatan',
                    'potongan_angsuran',
                    'potongan_zis',
                    'potongan_tabungan_pensiun',
                    'gaji_bersih'
                ];
                $sums = [];

                foreach ($columns as $column) {
                    $sums[$column] = DB::table('pengurus_pengawas_' . $tableName)
                        ->where('id_waktu', $last_id_waktu_pengurus_pengawas_cabang->id_waktu)
                        ->sum($column);
                }

                $gaji_bersih_pengurus = $sums['gaji_bersih'];

                $tunjangan_bpjs_kesehatan_pengurus_pengawas = $sums['tunjangan_bpjs_kesehatan'];
                $tunjangan_bpjs_tk_jp_pengurus_pengawas = $sums['tunjangan_bpjs_tk_jp'];
                $tunjangan_transport_pengurus_pengawas = $sums['tunjangan_transport'];
                $tunjangan_makan_pengurus_pengawas = $sums['tunjangan_makan'];
                $tunjangan_jabatan_pengurus_pengawas = $sums['tunjangan_jabatan'];
                $tunjangan_lain_lain_pengurus_pengawas = $sums['tunjangan_lain_lain'];
                $tunjangan_natura_pengurus_pengawas = $sums['tunjangan_natura'];
                $tunjangan_kesehatan_pengurus_pengawas = $sums['tunjangan_kesehatan'];

                $jumlah_tunjangan_pengurus_pengawas = $tunjangan_bpjs_kesehatan_pengurus_pengawas + $tunjangan_bpjs_tk_jp_pengurus_pengawas + $tunjangan_transport_pengurus_pengawas + $tunjangan_makan_pengurus_pengawas + $tunjangan_jabatan_pengurus_pengawas +  $tunjangan_lain_lain_pengurus_pengawas + $tunjangan_natura_pengurus_pengawas + $tunjangan_kesehatan_pengurus_pengawas;

                // Potongan

                $potongan_bpjs_tk_kesehatan_pengurus_pengawas = $sums['potongan_bpjs_tk_kesehatan'];
                $potongan_angsuran_pengurus_pengawas = $sums['potongan_angsuran'];
                $potongan_zis_pengurus_pengawas = $sums['potongan_zis'];
                $potongan_tabungan_pensiun_pengurus_pengawas = $sums['potongan_tabungan_pensiun'];

                $jumlah_potongan_pengurus_pengawas = $potongan_bpjs_tk_kesehatan_pengurus_pengawas + $potongan_angsuran_pengurus_pengawas + $potongan_zis_pengurus_pengawas + $potongan_tabungan_pensiun_pengurus_pengawas;

                $pengurus_pengawas_cabang = DB::table('data_pengurus_pengawas_' . $tableName)->count();
            } else {
                $gaji_bersih_pengurus = 0;
                $jumlah_tunjangan_pengurus_pengawas = 0;
                $jumlah_potongan_pengurus_pengawas = 0;
            };
        }
        if ($tableName) {
            // Gaji bersih semua
            $gaji_bersih_cabang_keseluruhan = $gaji_bersih_karyawan + $gaji_bersih_pengurus;
            //
            $tunjangan_cabang_keseluruhan = $jumlah_tunjangan_karyawan + $jumlah_tunjangan_pengurus_pengawas;
            // Potongan
            $potongan_cabang_keseluruhan = $jumlah_potongan_karyawan + $jumlah_potongan_pengurus_pengawas;
            // Karyawan semua
            $karyawan_cabang_keseluruhan = $karyawan_cabang + $pengurus_pengawas_cabang;
            // $karyawan_cabang_keseluruhan  = $total_karyawan_cabang + $total_karyawan_pusat_cabang;
        } else {
            $gaji_bersih_cabang_keseluruhan = 0;
            $tunjangan_cabang_keseluruhan = 0;
            $potongan_cabang_keseluruhan = 0;
            $karyawan_cabang_keseluruhan = 0;
        }


        $jumlah_semua = $total_karyawan + $total_pengurus;



        return view('dashboard.dashboard', compact(
            'gaji_bersih_cabang_keseluruhan',
            'tunjangan_cabang_keseluruhan',
            'potongan_cabang_keseluruhan',
            'karyawan_cabang_keseluruhan',
            'jumlah_semua_karyawan_pusat_cabang',
            'total_gaji_semuanya',
            'jumlah_semua',
            'bulan_terakhir',
            'total_gaji_sebelum',
            'dua_bulan_terakhir',
            'chart',
            'kantor_cabang',
            'jumlah_tunjangan_karyawan',
            'jumlah_reward_karyawan',
            'jumlah_bpjs_karyawan',
            'jumlah_potongan_karyawan',
            'waktu_karyawan',
            'total_karyawan_cabang',
            'jumlah_tunjangan_pengurus_pengawas',
            'jumlah_potongan_pengurus_pengawas',
            'waktus_pengurus_pengawas'
        ));
        // return view('dashboard.dashboard')->with('total_gaji', $total_gaji)->with('jumlah_semua', $jumlah_semua)->with('bulan_terakhir', $bulan_terakhir)->with('chart', $chart)->with('total_gaji_sebelum', $total_gaji_sebelum)->with('dua_bulan_terakhir', $dua_bulan_terakhir)->with('kantor_cabang', $kantor_cabang);
    }
}
