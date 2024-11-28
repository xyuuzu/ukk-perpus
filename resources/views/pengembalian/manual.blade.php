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
                        <h3 class="card-title">Tambah Pengembalian</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pengembalian.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="peminjaman_id" class="form-label">Pilih Peminjaman</label>
                                <select name="peminjaman_id" id="peminjaman_id" class="form-control select2" required>
                                    <option value="">-- Cari Peminjaman --</option>
                                    @foreach ($peminjaman as $item)
                                        <option value="{{ $item->id }}">
                                            #{{ $item->id }} - {{ $item->buku->judul }} - {{ $item->user->nama_lengkap }}
                                            (Tanggal Pinjam: {{ $item->tanggalPinjam }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal_pengembalian"
                                    name="tanggal_pengembalian" required>
                            </div>
                            <div class="form-group">
                                <label for="kondisi_buku" class="form-label">Kondisi Buku</label>
                                <select class="form-control" id="kondisi_buku" name="kondisi_buku" required>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak</option>
                                    <option value="hilang">Hilang</option>
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

