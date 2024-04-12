@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Edit User</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Edit User</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                        <div class="mb-4">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" placeholder="Masukkan Nama Lengkap" value="{{ $customer->nama_lengkap }}" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
                                            @error('nama_lengkap')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" placeholder="Masukkan Username" value="{{ $user->username }}" name="username" class="form-control" id="username" required>
                                            @error('username')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" placeholder="Masukkan Email" value="{{ $user->email }}" name="email" class="form-control" id="email" required>
                                            @error('email')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" placeholder="Masukkan Password" name="password" class="form-control" id="password">

                                        </div>

                                        <div class="mb-4">
                                            <label for="password-confirm" class="form-label">Confirm Password</label>
                                            <input type="password" placeholder="Masukkan Password Konfirmasi" name="password_confirmation" class="form-control" id="password-confirm">
                                            @error('password')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="telp" class="form-label">Telp</label>
                                            <input type="text" placeholder="Masukkan No Telp" value="{{ $customer->telp }}" name="telp" class="form-control" id="telp" required>
                                            @error('telp')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" id="role" class="form-control" required>
                                            <option value="" selected disabled>- Pilih Role -</option>
                                            @php
                                                $role = ['admin', 'customer'];
                                            @endphp
                                            @foreach ($role as $role)
                                                <option value="{{ $role }}" {{ ($user->role == $role) ? 'selected' : ''; }}>{{ ucfirst($role) }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- card end// -->
                </div>

            </div>
        </section> <!-- content-main end// -->


@endsection
