@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    

    .dashboard-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        padding: 2.5rem 1.8rem;
        text-align: center;
        cursor: pointer;
        transition: transform 0.35s cubic-bezier(0.4,0,0.2,1), box-shadow 0.35s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #222;
        border: 1px solid transparent;
    }

    .dashboard-card:hover {
        transform: scale(1.07);
        box-shadow: 0 18px 36px rgba(0,0,0,0.15);
        border-color: #4a90e2;
    }

    .icon-circle {
        margin: 0 auto 1.4rem;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #4a90e2;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 6px 15px rgba(74, 144, 226, 0.6);
        transition: background 0.35s ease, box-shadow 0.35s ease;
    }

    .dashboard-card:hover .icon-circle {
        background: #357ABD;
        box-shadow: 0 10px 30px rgba(53, 122, 189, 0.75);
    }

    .dashboard-icon {
        font-size: 2.8rem;
        color: #fff;
        line-height: 1;
    }

    .dashboard-title {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        margin-bottom: 0.5rem;
    }

    .dashboard-number {
        font-size: 2.8rem;
        font-weight: 900;
        color: #333;
        letter-spacing: 0.04em;
        margin: 0;
    }

    /* Badge styles for condition */
    .badge-status {
        display: inline-block;
        padding: 0.4em 1.1em;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 1rem;
        margin-top: 0.5rem;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        color: #fff;
        user-select: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .badge-baik {
        background-color: #28a745;
        box-shadow: 0 0 12px #28a745aa;
    }
    .badge-rusak {
        background-color: #dc3545;
        box-shadow: 0 0 12px #dc3545aa;
    }
    .badge-hilang {
        background-color: #6c757d;
        box-shadow: 0 0 12px #6c757daa;
    }
</style>

<div class="container">
    <h1 class="mb-4 text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="text-secondary mb-5">Ini adalah halaman dashboard utama sistem sarpras.</p>

    <div class="row g-4">
        {{-- Total Kategori --}}
        <div class="col-md-4">
            <a href="{{ route('kategori_barang.index') }}" class="dashboard-card text-decoration-none">
                <div class="icon-circle">
                    <i class="bi bi-tags dashboard-icon"></i>
                </div>
                <div class="dashboard-title">Total Kategori</div>
                <div class="dashboard-number">{{ $totalKategori ?? 0 }}</div>
            </a>
        </div>

        {{-- Total Barang --}}
        <div class="col-md-4">
            <a href="{{ route('data_barang.index') }}" class="dashboard-card text-decoration-none">
                <div class="icon-circle">
                    <i class="bi bi-box-seam dashboard-icon"></i>
                </div>
                <div class="dashboard-title">Total Barang</div>
                <div class="dashboard-number">{{ $totalBarang ?? 0 }}</div>
            </a>
        </div>

        {{-- Kondisi Barang --}}
        <div class="col-md-4">
            <a href="{{ route('laporan.barang') }}" class="dashboard-card text-decoration-none">
                <div class="icon-circle">
                    <i class="bi bi-clipboard-check dashboard-icon"></i>
                </div>
                <div class="dashboard-title">Kondisi Barang</div>
                <div>
                    <span class="badge-status badge-baik">Baik: {{ $barangBaik ?? 0 }}</span><br>
                    <span class="badge-status badge-rusak">Rusak: {{ $barangRusak ?? 0 }}</span><br>
                    <span class="badge-status badge-hilang">Hilang: {{ $barangHilang ?? 0 }}</span>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
