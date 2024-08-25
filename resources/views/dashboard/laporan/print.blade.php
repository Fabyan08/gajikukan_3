<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>Slip Gaji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 4px;
            white-space:nowrap;
            font-size:12px;
        }
    </style>
</head>

<body>
    <div>
        <div class="row justify-content-center" style="margin-left: -75px;">
            <div>
                <div>
                    <div style="text-align: center;">
                        <img src="{{ $imageSrc }}" alt="Logo" style="display: block; margin: 0 auto;">
                        <p>KANINDO Syariah</p>
                        <p> Jl. Raya Sengkaling No. 293 Mulyoagung, Kec. Dau, Malang</p>
                    </div>
                    <p style="margin-left:60px; white-space: nowrap;">
                        <b>
                            @if ($kantor == 'pusat')
                                Laporan Pendapatan Karyawan Pusat
                            @else
                                Laporan Pendapatan Karyawan Cabang {{ $kantor }}
                            @endif  <br/>
                            Periode {{ $month }} Tahun {{ $year }}
                        </b>
                    </p>
                    <div class="px-5">
                        @if ($gaji_karyawan != null && $gaji_pengurus_pengawas != null)
                            <table border="1" cellspacing="0" cellpadding="5">
                                <tr style="background-color: #FFCC00;">
                                    <th colspan="1">Kanindo Jatim</th>
                                    <th colspan="3" style="border-left: none; border-right: none;">Daftar Penggajian
                                    </th>
                                    <th colspan="1">Periode Berakhir: {{ $month }}</th>
                                </tr>
                                <tr style="background-color: #FFCC00;">
                                    <th>Nama Pegawai</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Gaji Kotor</th>
                                    <th>Gaji Bersih</th>
                                </tr>
                                @php
                                    $totalGajiPokok = 0;
                                    $totalTunjangan = 0;
                                    $totalGajiKotor = 0;
                                    $totalGajiBersih = 0;
                                @endphp
                                @foreach ($gaji_karyawan as $gaji)
                                    <tr>
                                        <td>{{ $gaji->nama }}</td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_pokok)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_makan + $gaji->tunjangan_transport + $gaji->tunjangan_senja + $gaji->tunjangan_hadir + $gaji->tunjangan_jabatan + $gaji->tunjangan_komunikasi + $gaji->tunjangan_natura)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_kotor)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_bersih)), 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    @php
                                        $totalGajiPokok += floatval(str_replace(',', '.', $gaji->gaji_pokok));
                                        $totalTunjangan += floatval(
                                            str_replace(
                                                ',',
                                                '.',
                                                $gaji->tunjangan_makan +
                                                    $gaji->tunjangan_transport +
                                                    $gaji->tunjangan_senja +
                                                    $gaji->tunjangan_hadir +
                                                    $gaji->tunjangan_jabatan +
                                                    $gaji->tunjangan_komunikasi +
                                                    $gaji->tunjangan_natura,
                                            ),
                                        );
                                        $totalGajiKotor += floatval(str_replace(',', '.', $gaji->gaji_kotor));
                                        $totalGajiBersih += floatval(str_replace(',', '.', $gaji->gaji_bersih));
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rp {{ number_format($totalGajiPokok, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalTunjangan, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalGajiKotor, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalGajiBersih, 2, ',', '.') }}</td>
                                </tr>
                            </table>

                            <table border="1" cellspacing="0" cellpadding="5" style="margin-top:20px;">
                                <tr style="background-color: #FFCC00;">
                                    <th colspan="1">Kanindo Jatim</th>
                                    <th colspan="5" style="border-left: none; border-right: none;">Daftar Potongan
                                    </th>
                                    <th colspan="1">Periode Berakhir: {{ $month }}</th>
                                </tr>
                                <tr style="background-color: #FFCC00;">
                                    <th>Nama Pegawai</th>
                                    <th>Angsuran</th>
                                    <th>ZIS</th>
                                    <th>BPJS</th>
                                    <th>Pensiun</th>
                                    <th>Ijin</th>
                                    <th>Total Lain-lain</th>
                                </tr>
                                @php
                                    $totalAngsuran = 0;
                                    $totalZIS = 0;
                                    $totalBPJS = 0;
                                    $totalPensiun = 0;
                                    $totalIjin = 0;
                                    $totalLainLain = 0;
                                @endphp
                                @foreach ($gaji_karyawan as $gaji)
                                    <tr>
                                        <td>{{ $gaji->nama }}</td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_angsuran)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_zis)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_pensiun)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_ijin)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->total_potongan)), 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    @php
                                        $totalAngsuran += floatval(str_replace(',', '.', $gaji->potongan_angsuran));
                                        $totalZIS += floatval(str_replace(',', '.', $gaji->potongan_zis));
                                        $totalBPJS += floatval(
                                            str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan),
                                        );
                                        $totalPensiun += floatval(str_replace(',', '.', $gaji->potongan_pensiun));
                                        $totalIjin += floatval(str_replace(',', '.', $gaji->potongan_ijin));
                                        $totalLainLain += floatval(str_replace(',', '.', $gaji->total_potongan));
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rp {{ number_format($totalAngsuran, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalZIS, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalBPJS, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalPensiun, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalIjin, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalLainLain, 2, ',', '.') }}</td>
                                </tr>
                            </table>

                        @endif

                    </div>
                    <p style="margin-left:60px;margin-top:50px;">
                        <b>
                            @if ($kantor == 'pusat')
                                Laporan Pendapatan Pengurus & Pengawas Pusat
                            @else
                                Laporan Pendapatan Pengurus & Pengawas Cabang
                                {{ $kantor }}
                            @endif <br/>
                            Periode {{ $month }} Tahun {{ $year }}
                        </b>
                    </p>
                    <div class="px-5">
                        @if ($gaji_pengurus_pengawas != null)
                            <table border="1" cellspacing="0" cellpadding="5">
                                <tr style="background-color: #FFCC00;">
                                    <th colspan="1">Kanindo Jatim</th>
                                    <th colspan="3" style="border-left: none; border-right: none;">Daftar Penggajian
                                    </th>
                                    <th colspan="1">Periode Berakhir: {{ $month }}</th>
                                </tr>
                                <tr style="background-color: #FFCC00;">
                                    <th>Nama Pegawai</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Gaji Kotor</th>
                                    <th>Gaji Bersih</th>
                                </tr>
                                @php
                                    $totalGajiPokok = 0;
                                    $totalTunjangan = 0;
                                    $totalGajiKotor = 0;
                                    $totalGajiBersih = 0;
                                @endphp
                                @foreach ($gaji_pengurus_pengawas as $gaji)
                                    <tr>
                                        <td>{{ $gaji->nama }}</td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_pokok)), 2, ',', '.') }}
                                        </td>
                                       <td>RP
                                            {{ number_format(
                                                floatval($gaji->tunjangan_bpjs_kesehatan ?? 0) + 
                                                floatval($gaji->tunjangan_bpjs_tk_jp ?? 0) + 
                                                floatval($gaji->tunjangan_makan ?? 0) + 
                                                floatval($gaji->tunjangan_transport ?? 0) + 
                                                floatval($gaji->tunjangan_jabatan ?? 0) + 
                                                floatval($gaji->tunjangan_lain_lain ?? 0) + 
                                                floatval($gaji->tunjangan_natura ?? 0) + 
                                                floatval($gaji->tunjangan_kesehatan ?? 0), 
                                                2, ',', '.')
                                            }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_kotor)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_bersih)), 2, ',', '.') }}
                                        </td>
                                    </tr>
                                 @php
                                    // Convert values to float, ensuring any non-numeric values are handled
                                                                           $totalGajiPokok += floatval(str_replace(',', '.', $gaji->gaji_pokok));

                                    $totalTunjangan += floatval(
    str_replace(
        ',',
        '.',
        (float)($gaji->tunjangan_bpjs_kesehatan ?? 0) +
        (float)($gaji->tunjangan_bpjs_tk_jp ?? 0) +
        (float)($gaji->tunjangan_makan ?? 0) +
        (float)($gaji->tunjangan_transport ?? 0) +
        (float)($gaji->tunjangan_jabatan ?? 0) +
        (float)($gaji->tunjangan_lain_lain ?? 0) +
        (float)($gaji->tunjangan_natura ?? 0) +
        (float)($gaji->tunjangan_kesehatan ?? 0)
    )
);

                                
                                
                                                                            $totalGajiKotor += floatval(str_replace(',', '.', $gaji->gaji_kotor));
                                                                            $totalGajiBersih += floatval(str_replace(',', '.', $gaji->gaji_bersih));

                                @endphp

                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rp {{ number_format($totalGajiPokok, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalTunjangan, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalGajiKotor, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalGajiBersih, 2, ',', '.') }}</td>
                                </tr>
                            </table>

                            <table border="1" cellspacing="0" cellpadding="5" style="margin-top:20px;">
                                <tr style="background-color: #FFCC00;">
                                    <th colspan="1">Kanindo Jatim</th>
                                    <th colspan="4" style="border-left: none; border-right: none;">Daftar Potongan
                                    </th>
                                    <th colspan="1">Periode Berakhir: {{ $month }}</th>
                                </tr>
                                <tr style="background-color: #FFCC00;">
                                    <th>Nama Pegawai</th>
                                    <th>Angsuran</th>
                                    <th>ZIS</th>
                                    <th>BPJS</th>
                                    <th>Pensiun</th>
                                    <th>Total Lain-lain</th>
                                </tr>
                                @php
                                    $totalAngsuran = 0;
                                    $totalZIS = 0;
                                    $totalBPJS = 0;
                                    $totalPensiun = 0;
                                    $totalIjin = 0;
                                    $totalLainLain = 0;
                                @endphp
                                @foreach ($gaji_pengurus_pengawas as $gaji)
                                    <tr>
                                        <td>{{ $gaji->nama }}</td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_angsuran)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_zis)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_tabungan_pensiun)), 2, ',', '.') }}
                                        </td>

                                         <td>Rp
                                            {{ number_format(floatval(str_replace(',', '.', $gaji->total_potongan)), 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    @php
                                        $totalAngsuran += floatval(str_replace(',', '.', $gaji->potongan_angsuran));
                                        $totalZIS += floatval(str_replace(',', '.', $gaji->potongan_zis));
                                        $totalBPJS += floatval(
                                            str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan),
                                        );
                                        $totalPensiun += floatval(
                                            str_replace(',', '.', $gaji->potongan_tabungan_pensiun),
                                        );
                                        $totalLainLain += floatval(str_replace(',', '.', $gaji->total_potongan));
                                    @endphp
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>Rp {{ number_format($totalAngsuran, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalZIS, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalBPJS, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalPensiun, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalLainLain, 2, ',', '.') }}</td>
                                </tr>
                            </table>
                        @endif

                    </div>
                </div>
             
            </div>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript"></script>
</body>

</html>
