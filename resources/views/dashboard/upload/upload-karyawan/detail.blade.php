<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/upload/gaji-karyawan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                               <h1>Data Ter-Upload Excel Gaji Bulan {{ $waktu->bulan }} Tahun {{ $waktu->tahun }} - HR Karyawan</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Upload Excel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Klik Detail Untuk Tahu Lebih Lanjut | Template Excel-> <a
                        href="/template-file/Gaji Karyawan.xlsx" class="btn btn-info" style="height: fit-content"><i
                            class="fas fa-file-download"></i></a></h2>
                @session('danger')
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('danger') }}
                        </div>
                    </div>
                @endsession
                @session('success')
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endsession

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    @if ($data_gaji->isNotEmpty())
                                        <h4>Data (Jika Terjadi Kesalahan, Hapus Data Lalu Upload Ulang Ya!)</h4>
                                    @else
                                        <h4>Data</h4>
                                    @endif
                                </div>

                                @if ($data_gaji->isNotEmpty())
                                    <form action="{{ route('gaji.delete', ['id_waktu' => $waktu->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button
                                            onclick="return confirm('Apakah anda yakin ingin menghapus semua data upload {{ $waktu->bulan }}-{{ $waktu->tahun }} ?')"
                                            type="submit" class="btn btn-icon h-fit icon-left btn-danger"
                                            style="height: fit-content">
                                            <i class="far fa-trash-alt"></i> Hapus Semua Data Upload
                                            {{ $waktu->bulan }}-{{ $waktu->tahun }}
                                        </button>
                                    </form>
                                @else
                                    <button data-toggle="modal" data-target="#tambah-modal"
                                        class="btn btn-icon h-fit icon-left btn-primary" style="height: fit-content">
                                        <i class="far fa-edit"></i> Tambah Data
                                    </button>
                                @endif

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Gaji Pokok</th>
                                                <th>Tunjangan</th>
                                                <th>Reward</th>
                                                <th>BPJS</th>
                                                <th>Potongan Gaji</th>
                                                <th>Detail</th>
                                                <th>PRINT SLIP GAJI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_gaji as $data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->gaji_pokok)), 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $total = 0;

                                                        // Define an array of values to sum up
                                                        $values = [$data->tunjangan_makan, $data->tunjangan_transport, $data->tunjangan_senja, $data->tunjangan_hadir, $data->tunjangan_jabatan, $data->tunjangan_komunikasi, $data->tunjangan_natura];

                                                        // Iterate through each value and add it to the total if it's numeric
                                                        foreach ($values as $value) {
                                                            // Check if the value is numeric and not empty
                                                            if (is_numeric($value)) {
                                                                $total += floatval(str_replace(',', '.', $value));
                                                            }
                                                        }

                                                        // Format the total
                                                        $formattedTotal = 'Rp' . number_format($total, 2, ',', '.');

                                                        echo $formattedTotal;
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        // Sum up the reward_funding and reward_lending values after converting them to float
                                                        $rewardTotal = 0;
                                                        $rewardFields = [$data->reward_funding, $data->reward_lending];
                                                        foreach ($rewardFields as $value) {
                                                            if (is_numeric($value)) {
                                                                $rewardTotal += floatval(str_replace(',', '.', $value));
                                                            }
                                                        }
                                                        // Format the total
                                                        $formattedRewardTotal = 'Rp' . number_format($rewardTotal, 2, ',', '.');
                                                        echo $formattedRewardTotal;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // Sum up the bpjs_tk and bpjs_kesehatan values after converting them to float
                                                        $bpjsTotal = 0;
                                                        $bpjsFields = [$data->bpjs_tk, $data->bpjs_kesehatan];
                                                        foreach ($bpjsFields as $value) {
                                                            if (is_numeric($value)) {
                                                                $bpjsTotal += floatval(str_replace(',', '.', $value));
                                                            }
                                                        }
                                                        // Format the total
                                                        $formattedBpjsTotal = 'Rp' . number_format($bpjsTotal, 2, ',', '.');
                                                        echo $formattedBpjsTotal;
                                                        ?>
                                                    </td>

                                                    <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->total_potongan)), 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('gaji.detail', ['id_waktu' => $data->id_waktu, 'id' => $data->id]) }}"
                                                            class="btn btn-primary">Detail</a>
                                                    </td>
                                                    {{-- <td><button mo></button></td> --}}
                                                    <td>
                                                        <a href="{{ route('gaji.print_slip', ['id_waktu' => $data->id_waktu, 'id' => $data->id]) }}"
                                                            class="btn btn-icon icon-left btn-warning"><i
                                                                class="fas fa-print"></i> Print</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    {{-- Detail --}}

    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Slip Gaji Untuk Bulan {{ $waktu->bulan }} Tahun {{ $waktu->tahun }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gaji.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id_waktu" value="{{ $waktu->id }}" hidden>
                        <label>Import Data Excel</label>
                        <input type="file" class="form-control" name="file">
                        <button type="submit" class="btn btn-primary mt-4">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
