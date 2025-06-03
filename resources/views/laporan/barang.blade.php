@extends('layouts.app')

@section('content')
<style>
  .stat-card {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.5s forwards;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
    border: 1px solid #dee2e6;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
  }
  .stat-card:nth-child(1) {
    animation-delay: 0.1s;
  }
  .stat-card:nth-child(2) {
    animation-delay: 0.2s;
  }
  .stat-card:nth-child(3) {
    animation-delay: 0.3s;
  }

  @keyframes fadeUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .stat-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
  }

  .stat-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 1.1rem;
  }

  .stat-value {
    font-size: 2.5rem;
    font-weight: 700;
  }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="bi bi-bar-chart-line-fill me-2 text-primary"></i>Laporan Barang
        </h3>
        <a href="{{ route('laporan.barang.pdf') }}" class="btn btn-outline-danger shadow-sm">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
        </a>
    </div>

    <div class="card border-0 shadow rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-primary text-dark">
                    <tr>
                        <th style="width: 30%;">Nama Barang</th>
                        <th style="width: 25%;">Kategori</th>
                        <th style="width: 25%;">Status</th>
                        <th style="width: 20%;">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            @php
                                $status = strtolower($barang->status);
                                $color = match($status) {
                                    'baik' => 'success',
                                    'rusak' => 'danger',
                                    'dipinjam' => 'warning',
                                    'hilang' => 'secondary',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $color }} px-3 py-2 rounded-pill text-capitalize">
                                {{ $status }}
                            </span>
                        </td>
                        <td><span class="fw-semibold text-dark">{{ $barang->stok }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Tidak ada data barang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card Statistik kondisi barang dengan animasi dan warna sesuai status -->
    <div class="row mt-4 g-4">
        <div class="col-md-4">
            <div class="stat-card p-4 text-center">
                <div class="stat-title text-success">Barang Baik</div>
                <div class="stat-value text-success">{{ $jumlah_baik }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-4 text-center">
                <div class="stat-title text-danger">Barang Rusak</div>
                <div class="stat-value text-danger">{{ $jumlah_rusak }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card p-4 text-center">
                <div class="stat-title text-secondary">Barang Hilang</div>
                <div class="stat-value text-secondary">{{ $jumlah_hilang }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
