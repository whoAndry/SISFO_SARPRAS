<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #222;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Laporan Pengembalian Barang</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Barang</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $index => $pengembalian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengembalian->nama_peminjam }}</td>
                    <td>{{ $pengembalian->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $pengembalian->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $pengembalian->status }}</td>
                    <td>{{ $pengembalian->tanggal_kembali }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
