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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Buku</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('buku.update',$buku) }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-group">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $buku->judul }}" required>
                            </div>

                            <div class="form-group">
                                <label for="gambar" class="form-label">Gambar Buku</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*"
                                    >
                            </div>

                            <div class="form-group">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis"
                                    value="{{ $buku->penulis }}" required>
                            </div>

                            <div class="form-group">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" id="penerbit" name="penerbit"
                                    value="{{ $buku->penerbit }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                                <input type="date" class="form-control" id="tahunTerbit" name="tahunTerbit"
                                    value="{{ $buku->tahunTerbit }}" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori" class="form-control">
                                    <option value="{{$buku->kategori_id}}">{{$buku->kategori->nama}}</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
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
