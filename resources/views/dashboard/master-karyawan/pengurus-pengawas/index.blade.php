<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data HR Pengurus & Pengawas Aktif</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Semua HR Pengurus & Pengawas Aktif</div>
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
                    <h2 class="section-title">Unduh Template Excel-></h2> <a
                        href="/template-file/Data HR Pengurus & Pengawas.csv" class="btn btn-info"
                        style="height: fit-content"><i class="fas fa-file-download"></i></a>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    @if ($karyawan->isNotEmpty())
                                        <h4>Data (Jika Terjadi Kesalahan, Hapus Data Lalu Upload Ulang Ya!)</h4>
                                    @else
                                        <h4>Data</h4>
                                    @endif
                                </div>

                                <button style="height: fit-content; margin-right: 10px" data-toggle="modal"
                                    data-target="#tambah-manual" class="btn btn-icon h-fit icon-left btn-primary"><i
                                        class="fas fa-plus"></i>
                                    Tambah Manual</button>

                                @if ($karyawan->isNotEmpty())
                                    <form action="{{ route('data-pengurus_pengawas.delete') }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button
                                            onclick="return confirm('Apakah anda yakin ingin menghapus semua data upload karyawan ?')"
                                            type="submit" class="btn btn-icon h-fit icon-left btn-danger"
                                            style="height: fit-content">
                                            <i class="far fa-trash-alt"></i> Hapus Semua Data Karyawan
                                        </button>
                                    </form>
                                @else
                                    <button style="height: fit-content" data-toggle="modal" data-target="#tambah-modal"
                                        class="btn btn-icon h-fit icon-left btn-success"><i class="fas fa-upload"></i>
                                        Upload File</button>
                                @endif

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>ID Karyawan</th>
                                                <th>Nama Lengkap</th>
                                                <th>Jabatan</th>
                                                <th>Alamat</th>
                                                <th>Kontak</th>
                                                <th>WhatsApp</th>
                                                <th>Edit</th>
                                                <th>Nonaktifkan</th>
                                                <td>Hapus</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($karyawan as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->id_karyawan }}</td>
                                                    <td>{{ $data->nama_lengkap }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>0{{ $data->kontak }}</td>
                                                    <td><a href="https://wa.me/62{{ $data->kontak }}" target="_blank"
                                                            class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                                                    </td>
                                                    <td>
                                                        <button data-toggle="modal"
                                                            data-target="#edit-modal-{{ $data->id }}"
                                                            class="btn btn-warning"> <i
                                                                class="far fa-edit"></i></button>
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('data-pengurus_pengawas.nonaktif', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menonaktifkan karyawan {{ $data->nama_lengkap }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-danger"
                                                                style="height: fit-content">
                                                                <i class="fas fa-exchange-alt"></i> </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('data-pengurus_pengawas.delete_id', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus karyawan {{ $data->nama_lengkap }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-dark"
                                                                style="height: fit-content">
                                                                <i class="fas fa-trash"></i> </button>
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
    {{-- Edit --}}

    @foreach ($karyawan as $data)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal-{{ $data->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Karyawan: {{ $data->nama_lengkap }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data-pengurus_pengawas.update', ['id' => $data->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mt-4">
                                <label for="id_karyawan">ID Karyawan</label>
                                <input type="text" value="{{ $data->id_karyawan }}" class="form-control"
                                    name="id_karyawan" id="id_karyawan">
                            </div>
                            <div class="mt-4">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" value="{{ $data->nama_lengkap }}" class="form-control"
                                    name="nama_lengkap" id="nama_lengkap">
                            </div>
                            <div class="mt-4">
                                <label for="jabatan">Jabatan</label>
                                <input value="{{ $data->jabatan }}" type="text" class="form-control"
                                    name="jabatan" id="jabatan">
                            </div>
                            <div class="mt-4">
                                <label for="alamat">Alamat</label>
                                <input value="{{ $data->alamat }}" type="text" class="form-control"
                                    name="alamat" id="alamat">
                            </div>
                            <div class="mt-4">
                                <label for="kontak">Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">62</span>
                                    <input value="{{ $data->kontak }}" type="number" class="form-control"
                                        name="kontak" id="kontak" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="form-text" id="basic-addon4">Jangan Isi Dengan 0. (Contoh: 812345678909).
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-warning "><i
                                        class="fas fa-edit"></i>Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('data-pengurus_pengawas.import') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="file">Upload Data Pengurus & Pengawas</label>
                            <input type="file" class="form-control" name="file" id="file">
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
                    <h5 class="modal-title">Tambah Data Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('data-pengurus_pengawas.insert') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="id_karyawan">ID Karyawan</label>
                            <input type="text" class="form-control" name="id_karyawan" id="id_karyawan">
                        </div>
                        <div class="mt-4">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                        </div>
                        <div class="mt-4">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan">
                        </div>
                        <div class="mt-4">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat"> </textarea>
                        </div>
                        <div class="mt-4">
                            <label for="kontak">Kontak</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">62</span>
                                <input type="number" class="form-control" name="kontak" id="kontak"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-text" id="basic-addon4">Jangan Isi Dengan 0. (Contoh: 812345678909).
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
