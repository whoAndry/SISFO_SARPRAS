@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border-radius: 12px;
    }
    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .dashboard-icon {
        font-size: 4rem;
        opacity: 0.85;
    }
</style>

<div class="container">
    <h1 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p>Ini adalah halaman dashboard.</p>

    <div class="row mt-4 g-4">
        <div class="col-md-4">
            <div class="card bg-info text-white dashboard-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-tags dashboard-icon"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Total Kategori</h5>
                        <p class="display-3 mb-0">{{ $totalKategori ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark dashboard-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-box-seam dashboard-icon"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Total Barang</h5>
                        <p class="display-3 mb-0">{{ $totalBarang ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white dashboard-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-4">
                        <i class="bi bi-check-circle dashboard-icon"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Kondisi Barang</h5>
                        <p class="display-6 mb-0">Baik: {{ $barangBaik ?? 0 }}</p>
                        <p class="display-6 mb-0">Rusak: {{ $barangRusak ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
