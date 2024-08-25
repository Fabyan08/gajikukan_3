<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class GajiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $monthNames = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $totalGajiPerMonth = [];

        // Get the table list as done in the Controller
        $tables = DB::select('SHOW TABLES');
        $tableList = [];

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                if (strpos($value, 'karyawan_') === 0 || strpos($value, 'pengurus_pengawas_') === 0) {
                    $suffix = preg_replace('/^(karyawan_|pengurus_pengawas_)/', '', $value);
                    $tableList[$suffix] = $value;
                }
            }
        }

        $kantor_cabang = array_unique(array_keys($tableList));

        foreach ($monthNames as $month) {
            $totalGajiPerMonth[$month] = 0;

            // Calculate the main branch's salaries
            $gajiMainKaryawan = DB::table('karyawans')
                ->join('waktus', 'karyawans.id_waktu', '=', 'waktus.id')
                ->where('waktus.bulan', $month)
                ->where('waktus.tahun', date('Y'))
                ->sum('karyawans.gaji_bersih');

            $gajiMainPengurus = DB::table('pengurus_pengawas')
                ->join('waktus_pengurus_pengawas', 'pengurus_pengawas.id_waktu', '=', 'waktus_pengurus_pengawas.id')
                ->where('waktus_pengurus_pengawas.bulan', $month)
                ->where('waktus_pengurus_pengawas.tahun', date('Y'))
                ->sum('pengurus_pengawas.gaji_bersih');

            $totalGajiPerMonth[$month] += $gajiMainKaryawan + $gajiMainPengurus;

            // Calculate salaries for each branch
            foreach ($kantor_cabang as $branch) {
                $karyawanTable = "karyawan_" . $branch;
                $pengurusTable = "pengurus_pengawas_" . $branch;

                $gajiCabangKaryawan = DB::table($karyawanTable)
                    ->join('waktus_' . $branch, 'karyawan_' . $branch . '.id_waktu', '=', 'waktus_' . $branch . '.id')
                    ->where('waktus_' . $branch . '.bulan', $month)
                    ->where('waktus_' . $branch . '.tahun', date('Y'))
                    ->sum('gaji_bersih');

                $gajiCabangPengurus = DB::table($pengurusTable)
                    ->join('waktus_pengurus_pengawas_' . $branch, 'pengurus_pengawas_' . $branch . '.id_waktu', '=', 'waktus_pengurus_pengawas_' . $branch . '.id')
                    ->where('waktus_pengurus_pengawas_' . $branch . '.bulan', $month)
                    ->where('waktus_pengurus_pengawas_' . $branch . '.tahun', date('Y'))
                    ->sum('gaji_bersih');

                $totalGajiPerMonth[$month] += $gajiCabangKaryawan + $gajiCabangPengurus;
            }
        }

        // No formatting applied here, keep them as raw numbers
        $dataGajiPerMonth = array_values($totalGajiPerMonth);

        return $this->chart->barChart()
            ->setTitle('Grafik Data Gaji')
            ->setSubtitle('Total Gaji Tiap Bulan Selama Tahun ' . date('Y'))
            ->addData('Total Gaji', $dataGajiPerMonth)
            ->setXAxis($monthNames);
    }
}
