<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/tambah-kantor" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1 style="text-transform: capitalize">Data Kantor Cabang {{ $tableName }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item" style="text-transform: capitalize">Data Kantor Cabang {{ $tableName }}</div>
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
                                    <h5> Klik untuk detail</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4>Data Karyawan</h4>
                                            </div>
                                            <div class="card-body">
                                                <a href="/kantor-cabang/data-karyawan/{{ $tableName }}"
                                                    class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h4>Data Pengurus / Pengawas</h4>
                                            </div>
                                            <div class="card-body">
                                                <a href="/kantor-cabang/data-pengurus/{{ $tableName }}"
                                                    class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h4>Data Karyawan & Pengurus / Pengawas Tidak Aktif</h4>
                                            </div>
                                            <div class="card-body">
                                                <a href="/kantor-cabang/data-karyawan-nonaktif/{{ $tableName }}"
                                                    class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <h6 class="my-4"><b>Data Penggajian</b></h6>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h4>Gaji Karyawan</h4>
                                            </div>
                                            <div class="card-body">
                                                <a href="/kantor-cabang/gaji-karyawan/{{ $tableName }}"
                                                    class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h4>Gaji Pengurus & Pengawas</h4>
                                            </div>
                                            <div class="card-body">
                                                <a href="/kantor-cabang/gaji-pengurus-pengawas/{{ $tableName }}"
                                                    class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>







</x-app-layout>
