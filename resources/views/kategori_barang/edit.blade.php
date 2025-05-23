@extends('layouts.app')

@section('content')
<style>
    .btn-success {
        background-color: #383657;
        border: none;
    }
    .btn-success:hover {
        background-color:rgb(32, 34, 32);
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(56, 54, 87, 0.25);
        border-color: #383657;
    }
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 0.75rem;
    }
    .form-label {
        font-weight: 600;
        color: #383657;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-dark">Edit Kategori</h1>
        <a href="{{ route('kategori_barang.index') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kategori_barang.update', $kategoriBarang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori', $kategoriBarang->nama_kategori) }}"
                        required
                        autofocus
                    >
                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('kategori_barang.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="bi bi-x-lg"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
