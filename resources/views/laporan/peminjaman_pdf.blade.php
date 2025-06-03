<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #ddd; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nama_peminjam }}</td>
                    <td>{{ $p->barang->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->barang->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
