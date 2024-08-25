<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data Admin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Admin</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Admin Tidak Aktif</h2>


                <div class="row">

                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data Admin Tidak Aktif</h4>
                                </div>




                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Kode Penghuni</th>
                                                <th>Nama Penghuni</th>
                                                <th>Nomor Telepon</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admin as $key => $admins)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $admins->kode_penghuni }}</td>
                                                    <td class="align-middle">
                                                        {{ $admins->name }}
                                                    </td>

                                                    <td> {{ $admins->telepon }}
                                                    </td>
                                                    <td>
                                                        0202-2024
                                                    </td>
                                                    <td>
                                                        0202-2024
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-danger">{{ $admins->status }}</div>
                                                    </td>
                                                    <td>
                                                        <a href="/user/{{ $admins->id }}"
                                                            class="btn btn-primary">Detail</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('penghuni.activate', $admins->id) }}"
                                                            method="POST" id="activateForm{{ $admins->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" class="btn btn-success"
                                                                onclick="if (confirm('Apakah Kamu Yakin Ingin Menonaktifkan Penghuni Ini?')) document.getElementById('activateForm{{ $admins->id }}').submit();">
                                                                Aktifkan</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{-- <button class="btn btn-primary" id="toastr-2">Launch</button>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="mb-2">Info Message</div>
                                                    <button class="btn btn-primary" id="toastr-1">Launch</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="mb-2">Success Message</div>
                                                    <button class="btn btn-primary" id="toastr-2">Launch</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="mb-2">Warning Message</div>
                                                    <button class="btn btn-primary" id="toastr-3">Launch</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <div class="mb-2">Error Message</div>
                                                    <button class="btn btn-primary" id="toastr-4">Launch</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>



</x-app-layout>
