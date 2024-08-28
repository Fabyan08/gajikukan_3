<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/pph-21/pusat" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1 style="text-transform: capitalize">Data Ter-Upload CSV Kantor {{ $kantor }} Bulan
                    {{ $waktu->bulan }} Tahun
                    {{ $waktu->tahun }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Upload Excel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Klik Detail Untuk Tahu Lebih Lanjut | Template Excel-> <a
                        href="/template-file/Perhitungan PPh 21 Kanindo.xlsx" class="btn btn-info"
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
                                    @if ($pph->isNotEmpty())
                                        <h4>Data (Jika Terjadi Kesalahan, Hapus Data Lalu Upload Ulang Ya!)</h4>
                                    @else
                                        <h4>Data</h4>
                                    @endif
                                </div>

                                @if ($pph->isNotEmpty())
                                    <form action="{{ route('pph.delete_all_pusat', ['id_waktu' => $waktu->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="text" value=" name="table_name" hidden>
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
                                                <th>Nama Pegawai</th>
                                                <th>Status</th>
                                                <th>Penghasilan Bruto / Bulan</th>
                                                <th>Detail</th>
                                                <th>PRINT SLIP GAJI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pph as $data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nama_pegawai }}</td>
                                                    <td>{{ $data->status }}</td>
                                                    <td>Rp{{ number_format($data->penghasilan_bruto_bulan, 2, ',', '.') }}
                                                    </td>
                                                    <td><a href="{{ route('pph.waktu_detail_pusat', ['id_waktu' => $data->id_waktu, 'id' => $data->id]) }}"
                                                            class="btn btn-warning">Detail</a>
                                                    </td>
                                                    <td><a href="" class="btn btn-info">Print</a>
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
                    <form action="{{ route('pph.store_pusat', ['id_waktu' => $waktu->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label>Import Data Excel</label>
                        <input type="file" class="form-control" name="file">
                        <button type="submit" class="btn btn-primary mt-4">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
