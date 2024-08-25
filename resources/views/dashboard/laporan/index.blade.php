<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Laporan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan</div>
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


                            </div>
                            <div class="card-body">
                                <form action="{{ route('laporan.print') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="kantor">Kantor</label>
                                            <select required name="kantor" style="text-transform: capitalize"
                                                id="kantor" class="form-control">
                                                <option selected disabled value="">Pilih</option>
                                                <option value="pusat">Pusat</option>
                                                @foreach ($tableList as $index => $table)
                                                    <option value="{{ $table }}"
                                                        style="text-transform: capitalize">
                                                        {{ $table }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="">Bulan</label>
                                            <input required type="month" name="bulan" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit"
                                        style="height: fit-content; margin-right: 10px;color:white; width: 100%"
                                        class="btn btn-icon h-fit icon-left btn-danger mt-4"><i
                                            class="fas fa-print"></i>
                                        Export PDF</button>

                                </form>
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
                    <form action="{{ route('tambahkantor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <label for="nama_tabel">Nama Tabel</label>
                            <input type="text" class="form-control" name="nama_tabel" id="nama_tabel">
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
