@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="NamaKategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="NamaKategori" name="nama"
                                    placeholder="Masukkan Nama Kategori" required>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
