@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Data Pengembalian</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Kondisi Barang</th>
                    <th>Aksi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengembalians as $p)
                <tr>
                    <td>{{ $p->no }}</td>
                    <td>{{ $p->nama_peminjam }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td>{{ $p->kondisi_barang ?? '-' }}</td>
                    <td>{{ $p->aksi ?? '-' }}</td>
                    <td>
                        @if ($p->aksi == 'dikembalikan')
                            <span class="badge bg-success">Dikembalikan</span>
                        @elseif ($p->aksi == 'terlambat')
                            <span class="badge bg-danger">Terlambat</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
