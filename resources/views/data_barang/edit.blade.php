@extends('layouts.app')

@section('content')
<style>
    .bg-ungu {
        background-color: #383657;
    }

    .btn-ungu {
        background-color: #383657;
        color: white;
    }

    .btn-ungu:hover {
        background-color: #2f2d4a;
        color: white;
    }

    .btn-kuning {
        background-color: #ffc107;
        color: black;
    }

    .btn-kuning:hover {
        background-color: #e0aa06;
        color: black;
    }
</style>

<div class="container">
    <div class="card shadow rounded">
        <div class="card-header bg-ungu text-white">
            <h4 class="mb-0">Edit Data Barang</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('data_barang.update', $dataBarang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $dataBarang->nama_barang }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_barang_id" class="form-select" required>
                        @foreach ($kategoriBarangs as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == $dataBarang->kategori_barang_id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (kosongkan jika tidak diubah)</label>
                    <input type="file" name="gambar" class="form-control" id="gambarInput">
                    @if($dataBarang->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $dataBarang->gambar) }}" width="100" class="img-thumbnail mb-2">
                        </div>
                    @endif
                    <img id="preview" class="img-thumbnail" style="max-height: 150px; display: none;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="baik" {{ $dataBarang->status == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ $dataBarang->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="hilang" {{ $dataBarang->status == 'hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $dataBarang->stok }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('data_barang.index') }}" class="btn btn-kuning">← Kembali</a>
                    <button class="btn btn-ungu">🔄 Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('gambarInput');
    const preview = document.getElementById('preview');
    input.addEventListener('change', () => {
        const [file] = input.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>
@endpush
