@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Laporan Peminjaman</h1>
    <a href="{{ route('laporan.peminjaman.pdf') }}" class="btn btn-danger mb-3">Export PDF</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
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
</div>
@endsection
