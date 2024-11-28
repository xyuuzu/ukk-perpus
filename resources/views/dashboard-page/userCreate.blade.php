@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap Pengguna</label>
                                <input type="text" class="form-control" id="judul" name="nama_lengkap"
                                    placeholder="Rofiif nabil" required>
                            </div>

                            <div class="form-group">
                                <label for="gambar" class="form-label">Username</label>
                                <input type="text" class="form-control" id="judul" name="username"
                                placeholder="rofif" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                placeholder="rofif@gmail.com" required>
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label"> Alamat </label>
                                <input type="text" name="alamat" id="address" class="form-control"
                                    placeholder="Pilubang" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="••••••••" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="form-label">Role </label>
                                <select name="role" id="role" class="form-control">
                                        <option value="">-- Pilih Role --</option>
                                        <option value="petugas">petugas</option>
                                        <option value="peminjam">peminjam</option>
                                </select>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
