<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang.kategori')->get();

        return view('laporan.peminjaman', compact('peminjamans'));
    }

    public function exportPdf()
    {
        $peminjamans = Peminjaman::with('barang.kategori')->get();
        $pdf = Pdf::loadView('laporan.peminjaman_pdf', compact('peminjamans'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_peminjaman.pdf');
    }
}
