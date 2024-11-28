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
                        <h3>Edit Kategori</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('kategori.update',$kategori) }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="judul" name="nama"
                                    value="{{ $kategori->nama }}" required>
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
