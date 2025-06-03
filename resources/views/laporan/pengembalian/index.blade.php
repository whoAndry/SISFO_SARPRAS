@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Pengembalian</h1>
    <a href="{{ route('laporan.pengembalian.pdf') }}" class="btn btn-danger mb-3">Export PDF</a>

    <table class="table table-bordered">
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
</div>
@endsection
