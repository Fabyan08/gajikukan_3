<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/kantor-cabang/gaji-pengurus-pengawas/{{ $tableName }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1 style="text-transform: capitalize">Data Ter-Upload Excel Gaji Bulan {{ $waktu->bulan }} Tahun
                    {{ $waktu->tahun }} - HR Pengurus Pengawas Kantor Cabang {{ $tableName }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Upload Excel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Klik Detail Untuk Tahu Lebih Lanjut | Template Excel-> <a
                        href="/template-file/Gaji Pengurus Pengawas.xlsx" class="btn btn-info"
                        style="height: fit-content"><i class="fas fa-file-download"></i></a></h2>

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
                                    <form
                                        action="{{ route('kantor-cabang.gaji-pengurus-pengawas.delete', ['id_waktu' => $waktu->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="text" name="tableName" value="{{ $tableName }}" hidden>
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
                                                    {{-- <td>Rp{{ number_format($data->gaji_pokok, 0, ',', '.') }}</td> --}}
                                                    <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->gaji_pokok)), 2, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // Sum up the values after converting them to float
                                                        $total = 0;
                                                        $fields = [$data->tunjangan_bpjs_kesehatan, $data->tunjangan_bpjs_tk_jp, $data->tunjangan_makan, $data->tunjangan_transport, $data->tunjangan_jabatan, $data->tunjangan_lain_lain, $data->tunjangan_natura, $data->tunjangan_kesehatan];
                                                        foreach ($fields as $value) {
                                                            if (is_numeric($value)) {
                                                                $total += floatval(str_replace(',', '.', $value));
                                                            }
                                                        }
                                                        // Format the total
                                                        $formattedTotal = 'Rp' . number_format($total, 2, ',', '.');
                                                        echo $formattedTotal;
                                                        ?>
                                                    </td>
                                                    <td>Rp{{ number_format(floatval(str_replace(',', '.', $data->total_potongan)), 2, ',', '.') }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('kantor-cabang.gaji-pengurus-pengawas.detail_gaji', ['slug' => $tableName, 'id_waktu' => $data->id_waktu, 'id' => $data->id]) }}"
                                                            class="btn btn-primary">Detail</a>

                                                        {{-- <a href="/" class="btn btn-primary">Detail</a> --}}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('kantor-cabang.gaji-pengurus-pengawas.print', ['id_waktu' => $data->id, 'id' => $data->id_waktu, 'table_name' => $tableName]) }}"
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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form
                        action="{{ route('kantor-cabang.gaji-pengurus-pengawas.import', ['slug' => $tableName, 'id_waktu' => $waktu->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="tableName" value="{{ $tableName }}" hidden>
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
