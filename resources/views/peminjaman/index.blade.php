@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-primary">Peminjaman</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tenggat Waktu</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjamans as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->id }}</td>
                                <td>{{ $peminjaman->nama_peminjam }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                                <td>{{ $peminjaman->tenggat_waktu }}</td>
                                <td>
                                    {{ $peminjaman->barang ? $peminjaman->barang->nama_barang : 'Tidak ditemukan' }}
                                </td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>
                                    @if($peminjaman->status === 'pending')
                                        <span class="badge bg-warning text-dark">⏳ Pending</span>
                                    @elseif($peminjaman->status === 'diterima')
                                        <span class="badge bg-success">✅ Diterima</span>
                                    @else
                                        <span class="badge bg-danger">❌ Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($peminjaman->status === 'pending')
                                        <form action="{{ route('peminjaman.updateStatus', ['id' => $peminjaman->id, 'status' => 'diterima']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-check-circle"></i> Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('peminjaman.updateStatus', ['id' => $peminjaman->id, 'status' => 'ditolak']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x-circle"></i> Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <em>Tidak ada data peminjaman.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
