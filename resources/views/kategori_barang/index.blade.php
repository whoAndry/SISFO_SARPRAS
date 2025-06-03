@extends('layouts.app')

@section('content')
<style>
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.85);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .fade-in-up {
        opacity: 0;
        animation: fadeInScale 0.5s ease forwards;
    }

    /* Delay animation via classes */
    .delay-0 { animation-delay: 0s; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }
    .delay-6 { animation-delay: 0.6s; }
    .delay-7 { animation-delay: 0.7s; }
    .delay-8 { animation-delay: 0.8s; }
    .delay-9 { animation-delay: 0.9s; }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #383657;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: white;
    }

    .btn-primary, 
    .btn-utama {
        background-color: #383657;
        border: none;
        color: white;
    }

    .btn-primary:hover, 
    .btn-utama:hover {
        background-color: #2f2c4d;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(56, 54, 87, 0.25);
        border-color: #383657;
    }

    .search-form {
        background-color: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-kategori {
        border: none;
        border-radius: 1.25rem;
        box-shadow: 0 4px 14px rgba(56, 54, 87, 0.12);
        background: linear-gradient(to bottom right, #ffffff, #f8f9fc);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .card-kategori:hover {
        transform: scale(1.08) translateY(-5px);
        box-shadow: 0 10px 30px rgba(56, 54, 87, 0.3);
        z-index: 10;
    }

    .card-kategori .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #383657;
        margin-bottom: 0.5rem;
    }

    .card-icon {
        font-size: 2.5rem;
        color: #383657;
        opacity: 0.1;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }

    .card-id-badge {
        background-color: #383657;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.6rem;
        border-radius: 0.5rem;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .card-actions {
        margin-top: 1rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .title-header {
        font-size: 1.8rem;
        font-weight: 700;
        color: #383657;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="title-header">Kategori Barang</h1>
        <a href="{{ route('kategori_barang.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('kategori_barang.index') }}" class="row search-form mb-4 g-3 align-items-end">
        <div class="col-md-6">
            <label for="search" class="form-label">Cari Nama Kategori</label>
            <input type="text" name="search" id="search" class="form-control"
                placeholder="Contoh: Elektronik" value="{{ request('search') }}">
        </div>
        <div class="col-md-6 d-flex gap-2">
            <button type="submit" class="btn btn-utama w-50">
                <i class="bi bi-search"></i> Cari
            </button>
            <a href="{{ route('kategori_barang.index') }}" class="btn btn-secondary w-50">
                <i class="bi bi-x-lg"></i> Reset
            </a>
        </div>
    </form>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Grid Kategori --}}
    @if($kategoriBarangs->isEmpty())
        <p class="text-muted text-center my-4">Tidak ada data kategori.</p>
    @else
        <div class="row g-4">
            @foreach ($kategoriBarangs as $index => $kategori)
                @php
                    $delayClass = 'delay-' . ($index % 10); // limit ke 10 kelas delay
                @endphp
                <div class="col-md-4 col-sm-6">
                    <div class="card card-kategori fade-in-up {{ $delayClass }}">
                        <i class="bi bi-folder2-open card-icon"></i>
                        <div class="card-body">
                            <div class="card-id-badge">ID: {{  $loop->iteration }}</div>
                            <h5 class="card-title">{{ $kategori->nama_kategori }}</h5>
                            <div class="card-actions">
                                <a href="{{ route('kategori_barang.edit', $kategori->id) }}" class="btn btn-sm btn-warning shadow-sm" title="Edit">
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
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
