<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Upload Excel Gaji / HR Pengurus & Pengawas</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Upload Excel</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Upload Excel</h2>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data</h4>
                                </div>

                                <button data-toggle="modal" data-target="#tambah-modal"
                                    class="btn btn-icon h-fit icon-left btn-primary"><i class="far fa-edit"></i>
                                    Tambah Data</button>



                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-1">
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
                                                    <td><a href="{{ route('upload-pengurus.detail', $waktu->id) }}"
                                                            class="btn btn-primary">Detail & Tambah
                                                            Data</a></td>
                                                    <td>
                                                        <form
                                                            action="{{ route('gaji-pengurus.delete_waktus', ['id_waktu' => $waktu->id]) }}"
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
                    <form action="{{ route('upload-pengurus.store_waktu') }}" method="POST">
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
                                <option value="September" {{ old('bulan') == 'September' ? 'selected' : '' }}>September
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
                                    <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>
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



</x-app-layout>
