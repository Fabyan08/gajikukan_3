<x-app-layout>
    <div class="main-content" style="min-height: 731px;">

        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/chart-account" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Gaji</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Detail Gaji</div>
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
                <div>
                    <h2 class="section-title">Detail Data {{ $coa->nama }}</h2>
                    <button type="button" data-toggle="modal" data-target="#edit-modal"
                        class="btn btn-icon icon-left btn-info"><i class="fas fa-edit"></i>
                        Edit Data</button>
                </div>

                <div class="row">
                    <div class="col-8">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h4>Data</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="text-align: end">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">ID Karyawan</th>
                                            <td style="text-align: end">{{ $coa->id_karyawan }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nama Karyawan</th>
                                            <td style="text-align: end">{{ $coa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jenis Kelamin</th>
                                            <td style="text-align: end">{{ $coa->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jabatan</th>
                                            <td style="text-align: end">{{ $coa->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Divisi</th>
                                            <td style="text-align: end">{{ $coa->divisi }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Masa Kerja</th>
                                            <td style="text-align: end">{{ $coa->masa_kerja }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status Karyawan</th>
                                            <td style="text-align: end">{{ $coa->status_karyawan }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Alamat</th>
                                            <td style="text-align: end">{{ $coa->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">NPWP</th>
                                            <td style="text-align: end">{{ $coa->npwp }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td style="text-align: end">{{ $coa->email }}</td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h4>HAPUS DATA</h4>
                                            <form action="{{ route('coa.delete', $coa->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                    type="submit" class="btn btn-icon h-fit icon-left btn-danger"
                                                    style="height: fit-content">
                                                    <i class="far fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                </form>


            </div>
        </section>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('coa.update', $coa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="id_karyawan">ID Karyawan</label>
                                <input type="number" value="{{ $coa->id_karyawan }}" class="form-control"
                                    name="id_karyawan" id="id_karyawan">
                            </div>
                            <div class="col">
                                <label for="nama_karyawan">Nama Karyawan</label>
                                <input type="text" value="{{ $coa->nama }}" class="form-control"
                                    name="nama_karyawan" id="nama_karyawan">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="id_karyawan">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option @if ($coa->jenis_kelamin == 'Laki-laki') selected @endif value="Laki-laki">
                                        Laki-laki</option>
                                    <option @if ($coa->jenis_kelamin == 'Perempuan') selected @endif value="Perempuan">
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control">

                                    <option @if ($coa->jabatan == 'Ketua') selected @endif value="Ketua">Ketua
                                    </option>
                                    <option @if ($coa->jabatan == 'Sekretaris') selected @endif value="Sekretaris">
                                        Sekretaris</option>
                                    <option @if ($coa->jabatan == 'Bendahara') selected @endif value="Bendahara">
                                        Bendahara</option>
                                    <option @if ($coa->jabatan == 'Ketua Pengawas') selected @endif value="Ketua Pengawas">
                                        Ketua Pengawas </option>
                                    <option @if ($coa->jabatan == 'Anggota Pengawas ') selected @endif
                                        value="Anggota Pengawas ">Anggota Pengawas </option>
                                    <option @if ($coa->jabatan == 'Manajer Operasional ') selected @endif
                                        value="Manajer Operasional ">Manajer Operasional </option>
                                    <option @if ($coa->jabatan == 'Manajer Bisnis') selected @endif value="Manajer Bisnis">
                                        Manajer Bisnis </option>
                                    <option @if ($coa->jabatan == 'Pembukuan Pusat ') selected @endif value="Pembukuan Pusat ">
                                        Pembukuan Pusat </option>
                                    <option @if ($coa->jabatan == 'Kasir Pusat ') selected @endif value="Kasir Pusat ">
                                        Kasir Pusat </option>
                                    <option @if ($coa->jabatan == 'Kepala Cabang ') selected @endif value="Kepala Cabang ">
                                        Kepala Cabang </option>
                                    <option @if ($coa->jabatan == 'Account Officer ') selected @endif
                                        value="Account Officer ">Account Officer </option>
                                    <option @if ($coa->jabatan == 'Customer Service ') selected @endif
                                        value="Customer Service ">Customer Service </option>
                                    <option @if ($coa->jabatan == 'Satpam ') selected @endif value="Satpam ">Satpam
                                    </option>
                                    <option @if ($coa->jabatan == 'Internal Control ') selected @endif
                                        value="Internal Control ">Internal Control </option>
                                    <option @if ($coa->jabatan == 'Remidial') selected @endif value="Remidial">
                                        Remidial</option>
                                    <option @if ($coa->jabatan == 'Ka Capem ') selected @endif value="Ka Capem ">Ka
                                        Capem </option>
                                    <option @if ($coa->jabatan == 'Umum') selected @endif value="Umum">Umum
                                    </option>
                                    <option @if ($coa->jabatan == 'OB & Jaga Malam') selected @endif
                                        value="OB & Jaga Malam">OB & Jaga Malam</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="divisi">Divisi</label>
                                <input value="{{ $coa->divisi }}" type="text" class="form-control"
                                    name="divisi" id="divisi">
                            </div>
                            <div class="col">
                                <label for="masa_kerja">Masa Kerja</label>
                                <input type="text" value="{{ $coa->masa_kerja }}" class="form-control"
                                    name="masa_kerja" id="masa_kerja">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="status_karyawan">Status Karyawan</label>
                                <input type="text" value="{{ $coa->status_karyawan }}" class="form-control"
                                    name="status_karyawan" id="status_karyawan">
                            </div>
                            <div class="col">
                                <label for="alamat">Alamat</label>
                                <input type="text" value="{{ $coa->alamat }}" class="form-control"
                                    name="alamat" id="alamat">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="npwp">NPWP</label>
                                <input type="text" value="{{ $coa->npwp }}" class="form-control"
                                    name="npwp" id="npwp">
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $coa->email }}" class="form-control"
                                    name="email" id="email">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-warning "><i class="fas fa-edit"></i> Edit</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>



</x-app-layout>
