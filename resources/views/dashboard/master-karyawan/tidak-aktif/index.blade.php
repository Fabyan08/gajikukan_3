<x-app-layout>
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data Karyawan & Pengurus / Pengawas Tidak Aktif</h1>
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
                <div class="d-flex" style="align-items: center; gap: 10px">
                    <p class="section-title">
                    <div class="badge badge-danger">Tidak Aktif</div>
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">

                                    <h4>Data</h4>

                                </div>

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
                                                <th>Aktifkan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $dt)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dt['id_karyawan'] }}</td>
                                                    <td>{{ $dt['nama_lengkap'] . ' (' . $dt['badge'] . ')' }}</td>
                                                    <td>{{ $dt['jabatan'] }}</td>
                                                    <td>{{ $dt['alamat'] }}</td>
                                                    <td>0{{ $dt['kontak'] }}</td>
                                                    <td><a href="https://wa.me/62{{ $dt['kontak'] }}" target="_blank"
                                                            class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('aktifkan', ['id' => $dt['id']]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('put')
                                                            <input hidden type="text" name="badge"
                                                                value="{{ $dt['badge'] }}"">
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin mengaktifkan {{ $dt['nama_lengkap'] }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-success"
                                                                style="height: fit-content">
                                                                <i class="fas fa-exchange-alt"></i> </button>
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



</x-app-layout>
