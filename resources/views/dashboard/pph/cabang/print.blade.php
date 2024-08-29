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
            white-space: nowrap;
            font-size: 8.5px;
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
                    <div class="px-5">
                        @if ($pph != null)
                            <table border="1" cellspacing="0" cellpadding="5">
                                <tr style="background-color: #FFCC00;">
                                    <th>Nama Pegawai</th>
                                    <th>Status</th>
                                    <th>Penghasilan Bruto / Bln</th>
                                    <th>Penghasilan Disetahunkan</th>
                                    <th>Bonus</th>
                                    <th>THR</th>
                                    <th>Penghasilan Bruto</th>
                                    <th>Pengurangan Biaya Jabatan</th>
                                    <th>Penghasilan Neto Setahun</th>
                                    <th>PTKP</th>
                                    <th>PTKP Setahun</th>
                                    <th>Pph 21 (5%)</th>
                                    <th>Iuran Per Bulan</th>
                                </tr>
                                @foreach ($pph as $data)
                                    <tr>
                                        <td>{{ $data->nama_pegawai }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->penghasilan_bruto_bulan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->penghasilan_disetahunkan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->bonus)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->thr)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->penghasilan_bruto)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->pengurangan_biaya_jabatan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->jumlah_penghasilan_neto_setahun)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->ptkp)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->ptkp_disetahunkan)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->pph_21)), 2, ',', '.') }}
                                        </td>
                                        <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->iuran_per_bulan)), 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif

                    </div>
                </div>
                <div style="position: absolute; bottom:10; left:10">
                    <p style="white-space: nowrap; text-transform: capitalize">
                        <b>
                            Laporan Perhitungan PPh 21 - Kantor {{ $slug }}<br />
                            Bulan {{ $pph[0]->bulan }} Tahun {{ $pph[0]->tahun }}
                        </b>
                    </p>
                </div>
            </div>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript"></script>
</body>

</html>
