<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan Barang PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #212529;
            margin: 1rem;
        }

        h3 {
            color: #0d6efd;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.5rem;
        }

        thead {
            background-color: #cfe2ff;
            color: #212529;
        }

        th, td {
            padding: 0.5rem 0.75rem;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 10rem;
            text-transform: capitalize;
            color: #fff;
        }

        .bg-success { background-color: #198754; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; color: #212529; }
        .bg-secondary { background-color: #6c757d; }

        .text-center { text-align: center; }
        .text-muted { color: #6c757d; }

        /* Ringkasan barang */
        .summary-container {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .summary-card {
            flex: 1;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            min-width: 150px;
        }

        .summary-title {
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .summary-value {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .text-success { color: #198754; }
        .text-danger { color: #dc3545; }
        .text-secondary { color: #6c757d; }
    </style>
</head>
<body>
    <h3>Laporan Barang</h3>

    <table>
        <thead>
            <tr>
                <th style="width: 30%;">Nama Barang</th>
                <th style="width: 25%;">Kategori</th>
                <th style="width: 25%;">Status</th>
                <th style="width: 20%;">Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $barang)
                @php
                    $status = strtolower($barang->status);
                    $color = match($status) {
                        'baik' => 'bg-success',
                        'rusak' => 'bg-danger',
                        'dipinjam' => 'bg-warning',
                        'hilang' => 'bg-secondary',
                        default => 'bg-secondary',
                    };
                @endphp
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                    <td><span class="badge {{ $color }}">{{ $status }}</span></td>
                    <td class="text-center">{{ $barang->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Tidak ada data barang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Ringkasan barang -->
    <div class="summary-container">
        <div class="summary-card">
            <div class="summary-title text-success">Barang Baik</div>
            <div class="summary-value text-success">{{ $jumlah_baik }}</div>
        </div>
        <div class="summary-card">
            <div class="summary-title text-danger">Barang Rusak</div>
            <div class="summary-value text-danger">{{ $jumlah_rusak }}</div>
        </div>
        <div class="summary-card">
            <div class="summary-title text-secondary">Barang Hilang</div>
            <div class="summary-value text-secondary">{{ $jumlah_hilang }}</div>
        </div>
    </div>
</body>
</html>
