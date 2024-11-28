@extends('layouts.admin.template')

@section('content')
<div class="card">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card-header">
        <h4>Form Pengembalian Buku</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pengembalian.store', $peminjaman->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">Nama Peminjam</label>
                <input type="text" class="form-control" id="user" value="{{ $peminjaman->user->nama_lengkap }}" disabled>
            </div>
            <div class="mb-3">
                <label for="buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="buku" value="{{ $peminjaman->buku->judul }}" disabled>
            </div>
            <div class="mb-3">
                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
            </div>
            <div class="mb-3">
                <label for="kondisi_buku" class="form-label">Kondisi Buku</label>
                <select class="form-control" id="kondisi_buku" name="kondisi_buku" required>
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="denda" class="form-label">Denda</label>
                <input type="text" class="form-control" id="denda" name="denda" value="0" readonly>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('tanggal_pengembalian').addEventListener('change', function () {
        const tanggalKembali = new Date("{{ $peminjaman->tanggalKembali }}");
        const tanggalPengembalian = new Date(this.value);

        // Hitung selisih hari
        const selisihHari = Math.max(0, (tanggalPengembalian - tanggalKembali) / (1000 * 60 * 60 * 24));
        const denda = selisihHari * 1000;

        // Update input denda
        document.getElementById('denda').value = denda;
    });
</script>
@endsection
