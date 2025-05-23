@extends('layouts.app')

@section('content')
<style>
    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #383657;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        color: white;
    }

    .btn-primary {
        background-color: #383657;
        border: none;
    }

    .btn-primary:hover {
        background-color: #2f2c4d;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(56, 54, 87, 0.25);
        border-color: #383657;
    }

    .table thead {
        background-color: #f5f5f5;
        color: #383657;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-dark">Kategori Barang</h1>
        <a href="{{ route('kategori_barang.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>

    {{-- Form Pencarian --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form method="GET" action="{{ route('kategori_barang.index') }}" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="search" class="form-label fw-semibold text-dark">
                        <i class="bi bi-search"></i> Cari Nama Kategori
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" id="search" class="form-control border-start-0"
                            placeholder="Contoh: Elektronik" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('kategori_barang.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="bi bi-x-lg"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Kategori --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($kategoriBarangs->isEmpty())
                <p class="text-muted text-center my-4">Tidak ada data kategori.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Nama Kategori</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoriBarangs as $kategori)
                                <tr>
                                    <td>{{ $kategori->id }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kategori_barang.edit', $kategori->id) }}" class="btn btn-sm btn-warning me-1 shadow-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('kategori_barang.destroy', $kategori->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
