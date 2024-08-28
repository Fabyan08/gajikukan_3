<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Kantor Cabang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Semua Karyawan</div>
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
                    <h2 class="section-title">Data</a>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                </div>

                                <button style="height: fit-content; margin-right: 10px" data-toggle="modal"
                                    data-target="#tambah-manual" class="btn btn-icon h-fit icon-left btn-primary"><i
                                        class="fas fa-plus"></i>
                                    Tambah Kantor Cabang</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama Kantor Cabang</th>
                                                <th>Detail</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Kantor Pusat</td>
                                            <td><a href="/pph-21/pusat" class="btn btn-warning">Detail</a>
                                            </td>
                                            <td>DEFAULT</td>
                                        </tr>
                                        @foreach ($tableList as $index => $table)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $table }}</td>
                                                <td><a href="/pph-21/{{ $table }}"
                                                        class="btn btn-warning">Detail</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('pph.hapus_kantor') }}" method="POST"
                                                        onsubmit="return confirm('Apakah kamu yakin? Semua data akan hilang dan tidak bisa dikembalikan.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="table_name"
                                                            value="{{ $table }}">
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
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
                    <form action="{{ route('pph.tambah_kantor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="nama_tabel">Nama Tabel</label>
                            <input type="text" class="form-control" name="nama_tabel" id="nama_tabel"
                                oninput="this.value = this.value.toLowerCase();">
                            <p>Harap isi dengan huruf kecil</p>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-warning "><i class="fas fa-plus"></i>Tambah</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-manual">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambahkantor.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div>
                            <label for="nama_tabel">Table Name:</label>
                            <input class="form-control" type="text" id="nama_tabel" name="nama_tabel" required>
                        </div>
                        <button class="btn btn-danger mt-4" type="submit">Delete Table</button>
                    </form>


                </div>
            </div>
        </div>
    </div>



</x-app-layout>
