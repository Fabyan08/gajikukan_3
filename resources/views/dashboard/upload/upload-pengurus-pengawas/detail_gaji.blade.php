<x-app-layout>
    <div class="main-content" style="min-height: 731px;">

        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/upload/gaji-pengurus/detail/{{ $gaji->id }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Gaji {{ $gaji->nama }} Bulan {{ $gaji->bulan }} Tahun {{ $gaji->tahun }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Detail Gaji</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Lihat & Print Slip Gaji {{ $gaji->nama }}</h2>
                <button type="button" data-toggle="modal" data-target="#edit-modal"
                    class="btn btn-icon icon-left btn-info"><i class="fas fa-edit"></i>
                    Edit Data</button>
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
                                <table class="table table-sm ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" style="text-align: end">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Gaji Pokok</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_pokok)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan BPJS Kesehatan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_bpjs_kesehatan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan BPJS TK & JP</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_bpjs_tk_jp)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Makan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_makan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Transport</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_transport)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Jabatan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_jabatan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Lain-lain</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_lain_lain)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Natura</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_natura)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tunjangan Kesehatan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_kesehatan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gaji Kotor</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_kotor)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Potongan BPJS TK Kesehatan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_bpjs_tk_kesehatan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Potongan Angsuran</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_angsuran)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Potongan Zis</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_zis)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Potongan Tabungan Pensiun</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->potongan_tabungan_pensiun)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Potongan</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->total_potongan)), 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gaji Bersih</th>
                                            <td style="text-align:end">Rp
                                                {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_bersih)), 2, ',', '.') }}
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
                                        {{-- <div class="col">
                                            <h4>DETAIL DATA</h4>
                                            <button type="button" data-toggle="modal" data-target="#detail-modal"
                                                class="btn btn-icon icon-left btn-success"><i
                                                    class="fas fa-info-circle"></i>
                                                Detail</button>
                                        </div> --}}
                                        <div class="col">

                                            <h4>PRINT SLIP GAJI</h4>
                                            <a
                                                href="{{ route('gaji-pengurus.print_slip', ['id_waktu' => $gaji->id_waktu, 'id' => $id_waktu]) }}"class="btn btn-icon icon-left btn-warning"><i
                                                    class="fas fa-print"></i>Print</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col">
                                            <h6>No Kamar</h6>
                                            <p>{{ $data->no_kamar }}</p>
                                        </div>
                                        <div class="col">
                                            <h6>Lantai</h6>
                                            <p>{{ $data->lantai }}</p>
                                        </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </form>


            </div>
        </section>
    </div>
    {{-- <div class="modal fade" tabindex="-1" role="dialog" id="detail-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row">Gaji Pokok</th>
                                <td style="text-align:end">Rp {{ number_format(floatval(str_replace(',', '.', $gaji->gaji_pokok)), 2, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tunjangan</th>
                                <td style="text-align:end">Rp {{ number_format(floatval(str_replace(',', '.', $gaji->tunjangan_bpjs_kesehatan + $gaji->tunjangan_bpjs_tk_jp + $gaji->tunjangan_makan + $gaji->tunjangan_transport + $gaji->tunjangan_jabatan + $gaji->tunjangan_lain_lain + $gaji->tunjangan_natura + $gaji->tunjangan_kesehatan)), 2, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Potongan Gaji</th>
                                <td style="text-align:end">Rp {{ number_format(floatval(str_replace(',', '.', $gaji->total_potongan)), 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div> --}}
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
                    <form action="{{ route('gaji-pengurus.update', ['id' => $id_waktu, 'id_waktu' => $gaji->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" value="{{ $gaji->nama }}" name="nama"
                                    id="nama">
                            </div>
                            <div class="col">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" value="{{ $gaji->jabatan }}"
                                    name="jabatan" id="jabatan">
                            </div>
                            <div class="col">
                                <label for="Gaji Pokok">Gaji Pokok</label>
                                <input type="text" class="form-control " value="{{ $gaji->gaji_pokok }}"
                                    name="gaji_pokok" id="Gaji Pokok">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="Tunjangan BPJS Kesehatan">Tunjangan BPJS Kesehatan</label>
                                <input type="text" class="form-control "
                                    value="{{ $gaji->tunjangan_bpjs_kesehatan }}" name="tunjangan_bpjs_kesehatan"
                                    id="Tunjangan BPJS Kesehatan">
                            </div>
                            <div class="col">
                                <label for="Tunjangan BPJS TK & JP">Tunjangan BPJS TK & JP</label>
                                <input type="text" class="form-control "
                                    value="{{ $gaji->tunjangan_bpjs_tk_jp }}" name="tunjangan_bpjs_tk_jp"
                                    id="Tunjangan BPJS TK & JP">
                            </div>
                            <div class="col">
                                <label for="Tunjangan Makan">Tunjangan Makan</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_makan }}"
                                    name="tunjangan_makan" id="Tunjangan Makan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="Tunjangan Transport">Tunjangan Transport</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_transport }}"
                                    name="tunjangan_transport" id="Tunjangan Transport">
                            </div>
                            <div class="col">
                                <label for="Tunjangan Jabatan">Tunjangan Jabatan</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_jabatan }}"
                                    name="tunjangan_jabatan" id="Tunjangan Jabatan">
                            </div>
                            <div class="col">
                                <label for="Tunjangan Lain-lain">Tunjangan Lain-lain</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_lain_lain }}"
                                    name="tunjangan_lain_lain" id="Tunjangan Lain-lain">
                            </div>
                        </div>
                        <div class="row mt-2">

                            <div class="col">
                                <label for="Tunjangan Natura">Tunjangan Natura</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_natura }}"
                                    name="tunjangan_natura" id="Tunjangan Natura">
                            </div>
                            <div class="col">
                                <label for="Tunjangan Kesehatan">Tunjangan Kesehatan</label>
                                <input type="text" class="form-control " value="{{ $gaji->tunjangan_kesehatan }}"
                                    name="tunjangan_kesehatan" id="Tunjangan Kesehatan">
                            </div>
                            <div class="col">
                                <label for="Gaji Kotor">Gaji Kotor</label>
                                <input type="text" class="form-control " value="{{ $gaji->gaji_kotor }}"
                                    name="gaji_kotor" id="Gaji Kotor">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="Potongan BPJS TK Kesehatan">Potongan BPJS TK Kesehatan</label>
                                <input type="text" class="form-control "
                                    value="{{ $gaji->potongan_bpjs_tk_kesehatan }}" name="potongan_bpjs_tk_kesehatan"
                                    id="Potongan BPJS TK Kesehatan">
                            </div>
                            <div class="col">
                                <label for="potongan_angsuran">Potongan Angsuran</label>
                                <input type="text" class="form-control " value="{{ $gaji->potongan_angsuran }}"
                                    name="potongan_angsuran" id="potongan_angsuran">
                            </div>
                            <div class="col">
                                <label for="Potongan Zis">Potongan Zis</label>
                                <input type="text" class="form-control " value="{{ $gaji->potongan_zis }}"
                                    name="potongan_zis" id="Potongan Zis">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="Potongan Tabungan Pensiun">Potongan Tabungan Pensiun</label>
                                <input type="text" class="form-control "
                                    value="{{ $gaji->potongan_tabungan_pensiun }}" name="potongan_tabungan_pensiun"
                                    id="Potongan Tabungan Pensiun">
                            </div>
                            <div class="col">
                                <label for="Total Potongan">Total Potongan</label>
                                <input type="text" class="form-control " value="{{ $gaji->total_potongan }}"
                                    name="total_potongan" id="Total Potongan">
                            </div>
                            <div class="col">
                                <label for="Gaji Bersih">Gaji Bersih</label>
                                <input type="text" class="form-control " value="{{ $gaji->gaji_bersih }}"
                                    name="gaji_bersih" id="Gaji Bersih">
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
