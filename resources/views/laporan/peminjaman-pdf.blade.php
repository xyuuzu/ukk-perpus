<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4A5568; /* Gray-700 */
        }
        p {
            margin-bottom: 15px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f7fafc; /* Gray-100 */
            color: #4A5568; /* Gray-700 */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray */
        }
        tr:hover {
            background-color: #f1f1f1; /* Light gray on hover */
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Tanggal:{{ $date }}</p>
    <p>Berikut ini adalah laporan peminjaman buku!</p>
    <p>Buku yang sudah dikembalikan: {{ $pinjamCount }}</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Peminjam</th>
            <th>Status</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            {{-- <th>Status Pengembalian</th>
            <th>Tanggal Buku diKembalikan</th> --}}
        </tr>
        @foreach($pinjam as $return)
        <tr>
            <td>{{ $return->id }}</td>
            <td>{{ $return->buku->judul }}</td>
            <td>{{ $return->user->nama_lengkap }}</td>
            <td>{{ $return->status }}</td>
            <td>{{ $return->tanggalPinjam }}</td>
            <td>{{ $return->tanggalKembali }}</td>
            {{-- <td>{{ $return->pengembalian->status }}</td>
            <td>{{ $return->pengembalian->tanggal_pengembalian }}</td> --}}
        </tr>
        @endforeach
    </table>
</body>
</html>