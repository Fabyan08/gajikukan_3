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
                <h2 class="section-title">Data Admin Aktif</h2>
                @session('nonaktif')
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('nonaktif') }}
                        </div>
                    </div>
                @endsession

                @session('aktifkan')
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('aktifkan') }}
                        </div>
                    </div>
                @endsession
                @session('plus')
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('plus') }}
                        </div>
                    </div>
                @endsession
                @session('delete')
                    <div class="alert alert-dark alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('delete') }}
                        </div>
                    </div>
                @endsession

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data</h4>
                                </div>

                                <button data-toggle="modal" data-target="#tambah-modal"
                                    class="btn btn-icon h-fit icon-left btn-primary" style="height: fit-content"><i
                                        class="fas fa-plus"></i>
                                    Tambah Data</button>



                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Telepon</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Nonaktifkan</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admin as $key => $admins)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $admins->nama }}</td>
                                                    <td class="align-middle">
                                                        {{ $admins->email }}
                                                    </td>
                                                    <td>{{ $admins->no_telp }}</td>
                                                    <td>
                                                        @if ($admins->status == 'Aktif')
                                                            <div class="badge badge-success">{{ $admins->status }}</div>
                                                        @else
                                                            <div class="badge badge-danger">{{ $admins->status }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button data-toggle="modal"
                                                            data-target="#edit-modal-{{ $admins->id }}"
                                                            class="btn btn-icon h-fit icon-left btn-warning"
                                                            style="height: fit-content"><i class="far fa-edit"></i>
                                                            Edit</button>
                                                    </td>
                                                    <td>
                                                        @if ($admins->status == 'Aktif')
                                                            <form action="{{ route('admin.deactivate', $admins->id) }}"
                                                                method="POST" id="deactivateForm{{ $admins->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="if (confirm('Apakah Kamu Yakin Ingin Menonaktifkan Admin Ini?')) document.getElementById('deactivateForm{{ $admins->id }}').submit();">
                                                                    Nonaktifkan</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.activate', $admins->id) }}"
                                                                method="POST" id="activateForm{{ $admins->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success"
                                                                    onclick="if (confirm('Apakah Kamu Yakin Ingin Mengaktifkan Admin Ini?')) document.getElementById('deactivateForm{{ $admins->id }}').submit();">
                                                                    Aktifkan</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('admin.delete', ['id' => $admins->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus admin {{ $admins->nama }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-dark"
                                                                style="height: fit-content">
                                                                <i class="fas fa-trash"></i> </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    </div>
    {{-- Edit --}}
    @foreach ($admin as $key => $admins)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal-{{ $admins->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('admin.update', ['id' => $admins->id]) }}"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">

                                    <x-input-label for="name" :value="__('Nama')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name', $admins->nama)" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col">

                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email"
                                        name="email" :value="old('email', $admins->email)" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div class="mt-4">
                                <x-input-label for="telepon" :value="__('Telepon')" />
                                <x-text-input id="telepon" class="block mt-1 w-full" type="number" name="telepon"
                                    :value="old('telepon', $admins->no_telp)" required autocomplete="telepon" />
                                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                            </div>


                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary">Edit Data Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <!-- Name -->
                        <div class="row">
                            <div class="col">

                                <x-input-label for="name" :value="__('Nama')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="col">

                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Telepon --}}
                        <div class="mt-4">
                            <x-input-label for="telepon" :value="__('Telepon')" />
                            <x-text-input id="telepon" class="block mt-1 w-full" type="number" name="telepon"
                                :value="old('telepon')" required autocomplete="telepon" />
                            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>


                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan Data Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>
