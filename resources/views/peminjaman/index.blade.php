@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Peminjaman Barang</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $peminjaman->tenggat_waktu }}</td>
                    <td>{{ $peminjaman->barang }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>
                        @if($peminjaman->status == 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($peminjaman->status == 'Diterima')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($peminjaman->status == 'Pending')
                            <form action="{{ route('peminjaman.updateStatus', ['id' => $peminjaman->id, 'status' => 'Diterima']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Terima</button>
                            </form>
                            <form action="{{ route('peminjaman.updateStatus', ['id' => $peminjaman->id, 'status' => 'Ditolak']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        @else
                            <em>Tidak ada aksi</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Tidak ada data peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
