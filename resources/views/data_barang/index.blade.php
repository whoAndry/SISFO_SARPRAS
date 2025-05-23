@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        background-color: #f9f9f9;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .card-title {
        color: #383657;
        font-weight: 700;
    }

    .kategori-tag {
        color: #1565c0;
        font-weight: 600;
    }

    .badge-status-baik {
        background-color: #4caf50 !important;
        color: white;
    }

    .badge-status-rusak {
        background-color: #f44336 !important;
        color: white;
    }

    .badge-status-lain {
        background-color: #757575 !important;
        color: white;
    }

    .btn-utama {
        background-color: #383657;
        color: white;
        border: none;
    }

    .btn-utama:hover {
        background-color: #2e2c4a;
        color: white;
    }

    .btn-kuning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-kuning:hover {
        background-color: #e0aa06;
        color: white;
    }

    .btn-danger {
        background-color: #e53935;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b71c1c;
    }

    .search-form {
        background-color: #fff;
        border-radius: 0.75rem;
        padding: 1rem;
        box-shadow: 0 0 10px rgba(56, 54, 87, 0.1);
    }

    .search-form label {
        font-weight: 600;
        color: #383657;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark">Data Barang</h1>
        <a href="{{ route('data_barang.create') }}" class="btn btn-kuning">
            <i class="bi bi-plus-lg"></i> Tambah Barang
        </a>
    </div>

    {{-- Form Search dan Filter --}}
    <form method="GET" action="{{ route('data_barang.index') }}" class="row search-form mb-4 g-3 align-items-end">
        <div class="col-md-4">
            <label for="search" class="form-label">Cari Nama Barang</label>
            <input type="text" name="search" id="search" class="form-control"
                value="{{ request('search') }}" placeholder="Contoh: Proyektor">
        </div>
        <div class="col-md-4">
            <label for="kategori_id" class="form-label">Filter Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoriBarangs as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-utama w-50">
                <i class="bi bi-search"></i> Cari
            </button>
            <a href="{{ route('data_barang.index') }}" class="btn btn-secondary w-50">
                <i class="bi bi-x-lg"></i> Reset
            </a>
        </div>
    </form>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Data Barang --}}
    @if($dataBarangs->isEmpty())
        <p class="text-muted text-center">Tidak ada data barang.</p>
    @else
        <div class="row g-4">
            @foreach($dataBarangs as $barang)
                <div class="col-md-4 col-lg-3">
                    <div class="card card-custom h-100">
                        @if($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" class="card-img-top"
                                 alt="gambar barang"
                                 style="height: 180px; object-fit: cover; border-top-left-radius: 0.75rem; border-top-right-radius: 0.75rem;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <p class="mb-1"><strong>Kategori:</strong> <span class="kategori-tag">{{ $barang->kategori->nama_kategori }}</span></p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                @php $status = strtolower($barang->status); @endphp
                                @if($status == 'baik')
                                    <span class="badge badge-status-baik text-uppercase">{{ $barang->status }}</span>
                                @elseif($status == 'rusak')
                                    <span class="badge badge-status-rusak text-uppercase">{{ $barang->status }}</span>
                                @else
                                    <span class="badge badge-status-lain text-uppercase">{{ $barang->status }}</span>
                                @endif
                            </p>
                            <p class="mb-3"><strong>Stok:</strong> {{ $barang->stok }}</p>
                            <div class="mt-auto d-flex">
                                <a href="{{ route('data_barang.edit', $barang->id) }}" class="btn btn-kuning btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('data_barang.destroy', $barang->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
