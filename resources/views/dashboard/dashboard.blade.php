<x-app-layout>
    @if (Auth::user()->status == 'Aktif')
        <div class="main-content">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="card card-statistic-1" style="background: #8B322C;">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 style="color:white">Total Gaji Bulan Sebelumnya
                                    @if ($dua_bulan_terakhir)
                                        ({{ $dua_bulan_terakhir->bulan }})
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body" style="color:white">
                                Rp{{ number_format(floatval(str_replace(',', '.', $total_gaji_sebelum)), 2, ',', '.') }}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card card-statistic-1" style="background: #0F67B1; ">
                        <div class="card-icon bg-success">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 style="color:white">Total Gaji Terakhir
                                    @if ($bulan_terakhir)
                                        ({{ $bulan_terakhir }})
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body" style="color:white">
                                Rp{{ number_format(floatval(str_replace(',', '.', $total_gaji_semuanya)), 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card card-statistic-1" style="background: #074173;">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 style="color: white">Total Karyawan & Pengurus Terakhir</h4>
                            </div>
                            <div class="card-body" style="color: white">
                                {{ $jumlah_semua_karyawan_pusat_cabang }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>Data Kantor Cabang @if (request()->kantor_cabang)
                    <a href="/dashboard" class="btn btn-success">Reset</a>
                @endif
            </h5>
            <form action="">
                <label for="kantor_cabang">Kantor Cabang
                </label>
                <select name="kantor_cabang" style="text-transform: capitalize" id="kantor_cabang" class="form-control">
                    @foreach ($kantor_cabang as $index => $table)
                        <option value="{{ $table }}" @if (request()->kantor_cabang == $table) selected @endif><span
                                style="text-transform: capitalize">
                                {{ $table }}</span></option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>

            @if (request()->kantor_cabang)
                <div class="row">
                    <div class="col">
                        <h6 class="mt-2"><b>Data Gaji Karyawan Kantor Cabang <span
                                    style="text-transform: capitalize">{{ request()->kantor_cabang }}</span></b></h6>
                    </div>
                </div>
                {{-- <div class="row mt-2">
                    <div class="col-12">
                        <div class="card card-statistic-1" style="background: #8B322C">

                            <div class="card-wrap" style="padding:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        Jumlah Karyawan & Pengurus Terakhir
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    {{ $total_karyawan_cabang }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row mt-2">
                    <div class="col-lg-3 col-12">
                        <div class="card card-statistic-1"
                            style="background: #8B322C; display:flex; flex-direction:column">

                            <div class="card-wrap" styl
                                style="padding:10px"e="margin-top:-20px; margin-left:-12px;padding-bottom:4px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        @if ($waktu_karyawan)
                                            Tunjangan Bulan {{ $waktu_karyawan->bulan }} - {{ $waktu_karyawan->tahun }}
                                        @else
                                            Tunjangan
                                        @endif
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_tunjangan_karyawan)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-statistic-1"
                            style="background: #0F67B1; ;  display:flex; flex-direction:column ">

                            <div class="card-wrap" styl
                                style="padding:10px"e="margin-top:-20px; margin-left:-12px;padding-bottom:4px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        @if ($waktu_karyawan)
                                            Reward Bulan {{ $waktu_karyawan->bulan }} - {{ $waktu_karyawan->tahun }}
                                        @else
                                            Reward
                                        @endif
                                    </h4>
                                </div>
                                <div class="card-body" style="color:white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_reward_karyawan)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-statistic-1"
                            style="background: #074173;  display:flex; flex-direction:column ">

                            <div class="card-wrap" styl
                                style="padding:10px"e="margin-top:-20px; margin-left:-12px;padding-bottom:4px">
                                <div class="card-header">
                                    <h4 style="color: white">
                                        @if ($waktu_karyawan)
                                            Jumlah BPJS Bulan {{ $waktu_karyawan->bulan }} -
                                            {{ $waktu_karyawan->tahun }}
                                        @else
                                            BPJS
                                        @endif

                                    </h4>
                                </div>
                                <div class="card-body" style="color: white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_bpjs_karyawan)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="card card-statistic-1"
                            style="background: #074173;  display:flex; flex-direction:column ">

                            <div class="card-wrap" styl
                                style="padding:10px"e="margin-top:-20px; margin-left:-12px;padding-bottom:4px">
                                <div class="card-header">
                                    <h4 style="color: white">
                                        @if ($waktu_karyawan)
                                            Jumlah Potongan Bulan {{ $waktu_karyawan->bulan }} -
                                            {{ $waktu_karyawan->tahun }}
                                        @else
                                            Potongan
                                        @endif
                                    </h4>
                                </div>
                                <div class="card-body" style="color: white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_potongan_karyawan)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="mt-2"><b>Data Gaji Pengurus & Pengawas</b></h6>
                <div class="row mt-4">
                    <div class="col-lg-6 col-12">
                        <div class="card card-statistic-1" style="background: #8B322C;">

                            <div class="card-wrap" style="padding:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        @if ($waktus_pengurus_pengawas)
                                            Jumlah Tunjangan Bulan {{ $waktus_pengurus_pengawas->bulan }} -
                                            {{ $waktus_pengurus_pengawas->tahun }}
                                        @else
                                            Tunjangan
                                        @endif
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_tunjangan_pengurus_pengawas)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card card-statistic-1" style="background: #074173;">

                            <div class="card-wrap" style="padding:10px">
                                <div class="card-header">
                                    <h4 style="color: white">
                                        @if ($waktus_pengurus_pengawas)
                                            Jumlah Potongan Bulan {{ $waktus_pengurus_pengawas->bulan }} -
                                            {{ $waktus_pengurus_pengawas->tahun }}
                                        @else
                                            Potongan
                                        @endif
                                    </h4>
                                </div>
                                <div class="card-body" style="color: white">
                                    Rp{{ number_format(floatval(str_replace(',', '.', $jumlah_potongan_pengurus_pengawas)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6 class="mt-2"><b>Data Gaji Keseluruhan Karyawan & Pengurus Kantor Cabang <span
                                    style="text-transform: capitalize">{{ request()->kantor_cabang }}</span></b></h6>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <div class="card card-statistic-1" style="background: #8B322C">

                            <div class="card-wrap" style="padding-bottom:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        Total Gaji Bersih
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    {{ number_format(floatval(str_replace(',', '.', $gaji_bersih_cabang_keseluruhan)), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-statistic-1" style="background: #13750a">

                            <div class="card-wrap" style="padding-bottom:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        Total Tunjangan
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    {{ number_format(floatval(str_replace(',', '.', $tunjangan_cabang_keseluruhan)), 2, ',', '.') }}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-statistic-1" style="background: #290ab1">

                            <div class="card-wrap" style="padding-bottom:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        Total Potongan
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">
                                    {{ number_format(floatval(str_replace(',', '.', $potongan_cabang_keseluruhan)), 2, ',', '.') }}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-statistic-1" style="background: #79053b">

                            <div class="card-wrap" style="padding-bottom:10px">
                                <div class="card-header">
                                    <h4 style="color:white">
                                        Jumlah Karyawan
                                    </h4>

                                </div>
                                <div class="card-body" style="color:white">

                                    {{ $karyawan_cabang_keseluruhan }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
            <section class="section">
                <div class="row" style="margin-top: 20px">
                    <div class="col-12 mb-4">
                        <div class="hero bg-primary text-white">
                            <div class="hero-inner">
                                <h2>Selamat Datang, {{ Auth::user()->nama }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">

                <div class="card flex-fill w-100">
                    <div class="card-body col-12">
                        {{-- Chart --}}
                        {!! $chart->container() !!}

                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="main-content">
            <section class="section">
                <div class="row" style="margin-top: 70px">
                    <div class="col-12 mb-4">
                        <div class="hero bg-primary text-white">
                            <div class="hero-inner">
                                <h2>Mohon Maaf Data Kamu Sudah Dinonaktifkan, Hubungi Admin Terkait.</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
</x-app-layout>
