<x-app-layout>
    <div class="main-content" style="min-height: 731px;">

        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/pph-21/cabang/{{ $kantor }}/{{ $pph->id }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1 style="text-transform: capitalize">Detail {{ $pph->nama_pegawai }} Bulan {{ $pph->bulan }} Tahun
                    {{ $pph->tahun }} - Kantor Pusat</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Detail Gaji</div>
                </div>
            </div>
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
            <div class="section-body">
                <div>
                    <h2 class="section-title">Lihat & Print Data PPH {{ $pph->nama_pegawai }}</h2>
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
                                            <th scope="row">Nama Pegawai</th>
                                            <td style="text-align: end">
                                                {{ $pph->nama_pegawai }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td style="text-align: end">
                                                {{ $pph->status }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Penghasilan Bruto / Bulan</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->penghasilan_bruto_bulan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Penghasilan Disetahunkan</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->penghasilan_disetahunkan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bonus</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->bonus)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">THR</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->thr)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Penghasilan Bruto</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->penghasilan_bruto)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pengurangan Biaya Jabatan</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->pengurangan_biaya_jabatan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Jumlah Penghasilan Neto Setahun</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->jumlah_penghasilan_neto_setahun)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">PTKP</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->ptkp)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">PKP Setahun / Disetahunkan
                                            </th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->ptkp_disetahunkan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">PPH 21 5%</th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->pph_21)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Iuran Per Bulan/th>
                                            <td style="text-align: end">
                                                Rp{{ number_format(floatval(str_replace(',', '.', $pph->iuran_per_bulan)), 2, ',', '.') }}
                                            </td>
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
                                            <h4>PRINT PPH</h4>
                                            <a href="" class="btn btn-warning">
                                                <i class="fas fa-print"></i> Print
                                            </a>
                                            {{-- <a href="{{ route('kantor-cabang.gaji-karyawan.print', ['id_waktu' => $id_waktu, 'id' => $gaji->id, 'table_name' => $tableName]) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-print"></i> Print
                                            </a> --}}

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
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form
                        action="{{ route('pph.update_detail_data_cabang', ['slug' => $kantor, 'id_waktu' => $pph->id, 'id' => $pph->id_pph]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="nama_pegawai">Nama Pegawai</label>
                                <input type="text" class="form-control" value="{{ $pph->nama_pegawai }}"
                                    name="nama_pegawai" id="nama_pegawai">
                            </div>
                            <div class="col">
                                <label for="status">status</label>
                                <input type="text" class="form-control" value="{{ $pph->status }}"
                                    name="status" id="status">
                            </div>
                            <div class="col">
                                <label for="penghasilan_bruto_bulan">Penghasilan Bruto / Bulan</label>
                                <input type="text" class="form-control "
                                    value="{{ $pph->penghasilan_bruto_bulan }}" name="penghasilan_bruto_bulan"
                                    id="penghasilan_bruto_bulan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="penghasilan_disetahunkan">Penghasilan Disetahunkan</label>
                                <input type="text" class="form-control "
                                    value="{{ $pph->penghasilan_disetahunkan }}" name="penghasilan_disetahunkan"
                                    id="penghasilan_disetahunkan">
                            </div>
                            <div class="col">
                                <label for="bonus">Bonus</label>
                                <input type="text" class="form-control " value="{{ $pph->bonus }}"
                                    name="bonus" id="bonus">
                            </div>
                            <div class="col">
                                <label for="thr">THR</label>
                                <input type="text" class="form-control " value="{{ $pph->thr }}"
                                    name="thr" id="thr">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="penghasilan_bruto">Penghasilan Bruto</label>
                                <input type="text" class="form-control " value="{{ $pph->penghasilan_bruto }}"
                                    name="penghasilan_bruto" id="penghasilan_bruto">
                            </div>
                            <div class="col">
                                <label for="pengurangan_biaya_jabatan">Pengurangan Biaya Jabatan</label>
                                <input type="text" class="form-control "
                                    value="{{ $pph->pengurangan_biaya_jabatan }}" name="pengurangan_biaya_jabatan"
                                    id="pengurangan_biaya_jabatan">
                            </div>
                            <div class="col">
                                <label for="jumlah_penghasilan_neto_setahun">Jumlah Penghasilan Neto Setahun</label>
                                <input type="text" class="form-control "
                                    value="{{ $pph->jumlah_penghasilan_neto_setahun }}"
                                    name="jumlah_penghasilan_neto_setahun" id="jumlah_penghasilan_neto_setahun">
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col">
                                <label for="ptkp">PTKP</label>
                                <input type="text" class="form-control " value="{{ $pph->ptkp }}"
                                    name="ptkp" id="ptkp">
                            </div>
                            <div class="col">
                                <label for="ptkp_disetahunkan">PTKP Setahun / Disetahunkan</label>
                                <input type="text" class="form-control " value="{{ $pph->ptkp_disetahunkan }}"
                                    name="ptkp_disetahunkan" id="ptkp_disetahunkan">
                            </div>
                            <div class="col">
                                <label for="pph_21">PPH 21</label>
                                <input type="text" class="form-control " value="{{ $pph->pph_21 }}"
                                    name="pph_21" id="pph_21">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="iuran_per_bulan">Iuran Per Bulan</label>
                                <input type="text" class="form-control " value="{{ $pph->iuran_per_bulan }}"
                                    name="iuran_per_bulan" id="iuran_per_bulan">
                            </div>
                        </div>
                        <div class="mt-4 w-100 ">
                            <button type="submit" class="btn btn-info " style="width: 100%"><i
                                    class="fas fa-edit"></i>Edit
                                Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
