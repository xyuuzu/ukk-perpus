@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
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
                    <h3 class="card-title">Tambah Peminjaman</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('store-manual-peminjaman') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Peminjam : </label>
                           <select name="user_id" id="user_id" class="form-control">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->nama_lengkap}}</option>
                            @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="form-label">Judul Buku :</label>
                            <select name="buku_id" id="" class="form-control">
                                @foreach($bukus as $buku)
                                <option value="{{$buku->id}}">{{$buku->judul}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggalPinjam" class="form-label">Tanggal Pinjam :</label>
                            <input type="date" class="form-control" id="tanggalPinjam" name="tanggalPinjam" min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggalKembali" class="form-label">Tanggal Pengembalian :</label>
                            <input type="date" class="form-control" id="tanggalKembali" name="tanggalKembali" required>
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

