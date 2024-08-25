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
        }
    </style>
</head>

<body>
    <div>
        <div style="display:flex;justify-content: space-between;align-items: center;width: 100%">
            <p style="border: 1px solid black; text-align: center;width: 200px">Pribadi dan Rahasia</p>
        </div>
        <div style="position: absolute;z-index:100; right: 4;top: 4">
            <img src="{{ $imageSrc }}" alt="Logo" style="width: 50px;">
        </div>

        <div class="row justify-content-center">
            <div>
                <div>
                    <div>
                        <p><b>KANINDO Syariah Malang
                                <br>
                                Jl. Raya Sengkaling No. 293 Mulyoagung, Kec. Dau, Malang
                            </b>
                        </p>
                    </div>

                    <div>
                        <p style="font-size: 18px;"><b>
                                Slip Gaji <br>
                                Periode: {{ $gaji->bulan }} - {{ $gaji->tahun }}
                            </b>
                        </p>

                        <p class="fs-sm">
                            Nama: {{ $gaji->nama }} <br>
                            Jabatan: {{ $gaji->jabatan }}
                        </p>
                        <div class="border-top border-gray-200 pt-4 " style="margin-top:4px;">
                            <div class="row">
                                <div>
                                    <div style="float: left; width: 45%; ">
                                        <table class="table table-striped">
                                            <thead style="background-color: rgb(255, 178, 11); color:white">
                                                <tr>
                                                    <th>Komponen Pendapatan</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Gaji Pokok</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_pokok)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Makan</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_makan)), 2, ',', '.') }}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Transport</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_transport)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Senja</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_senja)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Hadir</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_hadir)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Jabatan</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_jabatan)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Komunikasi</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_komunikasi)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tunjangan Natura</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_natura)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Reward Lending</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->reward_lending)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Reward Funding</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->reward_funding)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS TK</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->bpjs_tk)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>BPJS Kesehatan</td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->bpjs_kesehatan)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Gaji Kotor</b></td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_kotor)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Gaji Bersih</b></td>
                                                    <td>Rp
                                                        {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_bersih)), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="margin-left: 50%; width: 45%; ">
                                        <div class="row">
                                            <table class="table table-striped">
                                                <thead style="background-color: rgb(255, 178, 11); color:white">
                                                    <tr>
                                                        <th>Komponen Potongan</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>BPJS TK Kesehatan</td>
                                                        <td>Rp
                                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan)), 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Potongan Angsuran</td>
                                                        <td>Rp
                                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_angsuran)), 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Potongan Ijin</td>
                                                        <td>Rp
                                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_ijin)), 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Potongan ZIS</td>
                                                        <td>Rp
                                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_zis)), 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Potongan Pensiun</td>
                                                        <td>Rp
                                                            {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_pensiun)), 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Total Potongan</b></td>
                                                        <td><b>Rp
                                                                {{ number_format(floatval(str_replace(',', '.', $gaji->total_potongan)), 2, ',', '.') }}</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr style="border: 2px solid black;position: absolute;bottom:100;">
                        <img src="{{ $imageSrc }}" alt="Logo"
                            style="width: 40px;position: absolute;left:4;bottom:4;">
                        <p style="position: absolute;left:50;bottom:1;"><b>Kanindo Syariah</b></p>
                        <div style="position: absolute; right:20;bottom:10;font-weight: bold">
                            <p>Malang, {{ date('d F Y') }}<br> Laporan Pendapatan/ Slip
                                Gaji <br>Kanindo Jatim</p>
                            <br><br><br><br><br>
                            <p>({{ Auth::user()->nama }}) <br>ID: {{ Auth::user()->id_karyawan }} </p>
                        </div>
                    </div>
                </div>
            </div>

            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript"></script>
</body>

</html>
