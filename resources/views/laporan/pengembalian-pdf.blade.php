<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Pengembalian Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-danger {
            color: red;
        }

        .email {
            font-size: 12px;
            color: #666;
        }

        .kop-surat {
            margin-bottom: 30px;
            position: relative;
            padding-top: 20px;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px;
            height: auto;
        }

        .header-text {
            text-align: center;
            margin-left: 120px;
        }

        .header-text h2 {
            font-size: 24px;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }

        .header-text p {
            font-size: 14px;
            margin: 5px 0;
            line-height: 1.4;
        }

        .divider {
            clear: both;
            border-bottom: 3px solid #000;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .divider-2 {
            border-bottom: 1px solid #000;
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 20px 0;
        }

        .footer p {
            margin: 3px 0;
        }

        .signature {
            margin-top: 15px;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <img src="{{ public_path('assets/images/smk4logo.jfif') }}" class="logo" alt="Logo">
        <div class="header-text">
            <h2>PERPUSTAKAAN ONLINE</h2>
            <p>Jl. Contoh No. 123, Kota, Provinsi</p>
            <p>Telp: (021) 1234567 | Email: perpustakaan@online.com</p>
        </div>
        <div class="divider"></div>
        <div class="divider-2"></div>
    </div>

    <h3 style="text-align: center;">LAPORAN PENGEMBALIAN BUKU</h3>
    <div class="periode">
        @php
            $date = request('date', date('Y-m-d'));
            $period = request('period', 'daily');
            
            switch($period) {
                case 'daily':
                    $periodText = 'Tanggal: ' . date('d F Y', strtotime($date));
                    break;
                case 'weekly':
                    $startWeek = date('d F Y', strtotime('monday this week', strtotime($date)));
                    $endWeek = date('d F Y', strtotime('sunday this week', strtotime($date)));
                    $periodText = "Periode: $startWeek - $endWeek";
                    break;
                case 'monthly':
                    $periodText = 'Periode: ' . date('F Y', strtotime($date));
                    break;
            }
        @endphp
        {{ $periodText }}
    </div>

    <p>Buku yang sudah dikembalikan: {{ $returnCount }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Peminjam</th>
                <th>Kondisi Buku</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $return)
            <tr>
                <td>{{ $return->id }}</td>
                <td>{{ $return->peminjaman->buku->judul }}</td>
                <td>
                    {{ $return->peminjaman->user->nama_lengkap }}<br>
                    <span class="email">{{ $return->peminjaman->user->email }}</span>
                </td>
                <td>{{ $return->kondisi_buku }}</td>
                <td>{{ \Carbon\Carbon::parse($return->tanggal_pengembalian)->format('d/m/Y') }}</td>
                <td>{{ $return->status }}</td>
                <td>{{ $return->denda ? 'Rp ' . number_format($return->denda, 0, ',', '.') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>{{ date('d F Y') }}</p>
        <p>Kepala Perpustakaan</p>
        <div class="signature">
            <br><br><br>
            <img src="{{ public_path('assets/images/ttd.png') }}" alt="" width="150">
            <p>_____________</p>
            <p>Yeni Nora Wiwi</p>
            <p>NIP. 123456789</p>
        </div>
    </div>
</body>

</html>
