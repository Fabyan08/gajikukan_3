<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/pph-21" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>PPH 21 Kantor Pusat</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">PPH 21 Kantor Pusat</div>
                </div>
            </div>

            <div class="section-body">

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
                @session('delete')
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('delete') }}
                        </div>
                    </div>
                @endsession
                @session('error')
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('error') }}
                        </div>
                    </div>
                @endsession
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
                @session('update')
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('update') }}
                        </div>
                    </div>
                @endsession
                @session('delete_id')
                    <div class="alert alert-dark alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('delete_id') }}
                        </div>
                    </div>
                @endsession
                <div class="d-flex" style="align-items: center; gap: 10px">
                    <h2 class="section-title">Tambahkan waktu</h2>

                </div>
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
                                    <form
                                        action="{{ route('kantor-cabang.gaji-karyawan.delete', ['id_waktu' => $waktu->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="text" value="{{ $tableName }}" name="table_name" hidden>
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
                                    <table class="table table-bordered table-hover" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Tanggal Upload</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                                <th>Detail</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_waktu as $waktu)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    @php
                                                        $englishMonths = [
                                                            'January',
                                                            'February',
                                                            'March',
                                                            'April',
                                                            'May',
                                                            'June',
                                                            'July',
                                                            'August',
                                                            'September',
                                                            'October',
                                                            'November',
                                                            'December',
                                                        ];
                                                        $indonesianMonths = [
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
                                                            'Desember',
                                                        ];

                                                        $tgl = date('d F Y', strtotime($waktu->tanggal));
                                                        $tanggal = str_replace($englishMonths, $indonesianMonths, $tgl);

                                                    @endphp

                                                    <td>{{ $tanggal }}</td>
                                                    <td>{{ $waktu->bulan }}</td>
                                                    <td>{{ $waktu->tahun }}</td>

                                                    <td>
                                                        <a href="{{ route('pph.index_pusat', ['id_waktu' => $waktu->id]) }}"
                                                            class="btn btn-primary">Detail & Tambah
                                                            Data</a>
                                                    </td>

                                                    <td>
                                                        <form
                                                            action="{{ route('pph.delete_waktu_pusat', ['id' => $waktu->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data waktu {{ $waktu->bulan }}-{{ $waktu->tahun }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-danger"
                                                                style="height: fit-content">
                                                                <i class="far fa-trash-alt"></i> Hapus
                                                            </button>
                                                        </form>
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
                    <h5 class="modal-title">Tambah Bulan & Tahun Dahulu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pph.store_waktu_pusat') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <label for="tanggal">Tanggal Upload</label>
                            <input type="date" value="{{ old('tanggal', date('Y-m-d')) }}" readonly
                                class="form-control" name="tanggal" id="tanggal">
                        </div>
                        <div class="mt-4">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option selected disabled value="">Pilih</option>
                                <option value="Januari" {{ old('bulan') == 'Januari' ? 'selected' : '' }}>Januari
                                </option>
                                <option value="Februari" {{ old('bulan') == 'Februari' ? 'selected' : '' }}>Februari
                                </option>
                                <option value="Maret" {{ old('bulan') == 'Maret' ? 'selected' : '' }}>Maret
                                </option>
                                <option value="April" {{ old('bulan') == 'April' ? 'selected' : '' }}>April
                                </option>
                                <option value="Mei" {{ old('bulan') == 'Mei' ? 'selected' : '' }}>Mei
                                </option>
                                <option value="Juni" {{ old('bulan') == 'Juni' ? 'selected' : '' }}>Juni
                                </option>
                                <option value="Juli" {{ old('bulan') == 'Juli' ? 'selected' : '' }}>Juli
                                </option>
                                <option value="Agustus" {{ old('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus
                                </option>
                                <option value="September" {{ old('bulan') == 'September' ? 'selected' : '' }}>
                                    September
                                </option>
                                <option value="Oktober" {{ old('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober
                                </option>
                                <option value="November" {{ old('bulan') == 'November' ? 'selected' : '' }}>November
                                </option>
                                <option value="Desember" {{ old('bulan') == 'Desember' ? 'selected' : '' }}>Desember
                                </option>
                                <!-- Other options -->
                            </select>
                            {{-- Error Input Information --}}
                            <p>{{ $errors->first('bulan') }}</p>
                        </div>
                        <div class="mt-4">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option selected disabled value="">Pilih</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ old('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                            <p>{{ $errors->first('tahun') }}</p>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary ">Tambah</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-manual">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('coa.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="id_karyawan">ID Karyawan</label>
                                <input type="number" class="form-control" name="id_karyawan" id="id_karyawan">
                            </div>
                            <div class="col">
                                <label for="nama_karyawan">Nama Karyawan</label>
                                <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="id_karyawan">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">
                                    <option value="Ketua">Ketua</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Ketua Pengawas">Ketua Pengawas </option>
                                    <option value="Anggota Pengawas ">Anggota Pengawas </option>
                                    <option value="Manajer Operasional ">Manajer Operasional </option>
                                    <option value="Manajer Bisnis ">Manajer Bisnis </option>
                                    <option value="Pembukuan Pusat ">Pembukuan Pusat </option>
                                    <option value="Kasir Pusat ">Kasir Pusat </option>
                                    <option value="Kepala Cabang ">Kepala Cabang </option>
                                    <option value="Account Officer ">Account Officer </option>
                                    <option value="Customer Service ">Customer Service </option>
                                    <option value="Satpam ">Satpam </option>
                                    <option value="Internal Control ">Internal Control </option>
                                    <option value="Remidial">Remidial</option>
                                    <option value="Ka Capem ">Ka Capem </option>
                                    <option value="Umum">Umum</option>
                                    <option value="OB & Jaga Malam">OB & Jaga Malam</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="divisi">Divisi</label>
                                <input type="text" class="form-control" name="divisi" id="divisi">
                            </div>
                            <div class="col">
                                <label for="masa_kerja">Masa Kerja</label>
                                <input type="text" class="form-control" name="masa_kerja" id="masa_kerja">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="status_karyawan">Status Karyawan</label>
                                <input type="text" class="form-control" name="status_karyawan"
                                    id="status_karyawan">
                            </div>
                            <div class="col">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="npwp">NPWP</label>
                                <input type="text" class="form-control" name="npwp" id="npwp">
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-warning "><i
                                    class="fas fa-plus"></i>Tambah</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>



</x-app-layout>
