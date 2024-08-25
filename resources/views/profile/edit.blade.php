<x-app-layout>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ Auth::user()->nama }}!</h2>
                <p class="section-lead">
                    Kamu bisa edit data kamu di sini.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="img/avatar/avatar-1.png"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">

                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ Auth::user()->nama }}<div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>
                                        @if ($user->level == 'admin')
                                            Admin Sistem
                                        @elseif($user->level == 'user')
                                            Penghuni Kos
                                        @endif
                                    </div>
                                </div>
                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')

                                    <div>
                                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                        <input class="form-control" id="update_password_current_password"
                                            name="current_password" type="password" class="mt-1 block w-full"
                                            autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password" :value="__('New Password')" />
                                        <input class="form-control" id="update_password_password" name="password"
                                            type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                        <input class="form-control" id="update_password_password_confirmation"
                                            name="password_confirmation" type="password" class="mt-1 block w-full"
                                            autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center gap-4 mt-2">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>

                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 ">
                                                {{ __('Telah Tersimpan!.') }}</p>
                                        @endif
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>


                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>

                            @session('status')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Berhasil Diedit!') }}</p>
                            @endsession
                            <form method="post" action="{{ route('profile.update', ['id' => $user->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Nama</label>
                                            <x-text-input id="name" name="name" type="text"
                                                class="mt-1 block w-full" :value="old('name', $user->nama)" required autofocus
                                                autocomplete="name" />

                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" name="email" type="email"
                                                class="mt-1 block w-full" :value="old('email', $user->email)" required
                                                autocomplete="username" />
                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <x-input-label for="No Telepon" :value="__('No Telepon')" />
                                            <x-text-input id="telepon" name="telepon" type="number"
                                                class="mt-1 block w-full" :value="old('telepon', $user->no_telp)" required
                                                autocomplete="telepon" />
                                            <x-input-error class="mt-2" :messages="$errors->get('telepon')" />

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <x-input-label for="ID Karyawan" :value="__('ID Karyawan')" />
                                            <x-text-input id="id_karyawan" name="id_karyawan" type="text"
                                                class="mt-1 block w-full" :value="old('id_karyawan', $user->id_karyawan)" required
                                                autocomplete="id_karyawan" />
                                            <x-input-error class="mt-2" :messages="$errors->get('id_karyawan')" />

                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Edit Perubahan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
