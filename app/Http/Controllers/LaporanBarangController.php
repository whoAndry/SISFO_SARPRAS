<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBarangController extends Controller
{
    // Menampilkan halaman laporan di browser
    public function index(): View
    {
        $barangs = DataBarang::with('kategori')->get();

        // Hitung total stok berdasarkan status
        $jumlah_baik = $barangs->where('status', 'baik')->sum('stok');
        $jumlah_rusak = $barangs->where('status', 'rusak')->sum('stok');
        $jumlah_hilang = $barangs->where('status', 'hilang')->sum('stok'); // Sesuaikan jika status 'hilang' beda

        return view('laporan.barang', compact('barangs', 'jumlah_baik', 'jumlah_rusak', 'jumlah_hilang'));
    }

    // Export laporan ke PDF
    public function exportPdf()
    {
        $barangs = DataBarang::with('kategori')->get();

        // Hitung total stok untuk PDF juga (kalau dibutuhkan di view PDF)
        $jumlah_baik = $barangs->where('status', 'baik')->sum('stok');
        $jumlah_rusak = $barangs->where('status', 'rusak')->sum('stok');
        $jumlah_hilang = $barangs->where('status', 'hilang')->sum('stok');

        $pdf = Pdf::loadView('laporan.barang_pdf', compact('barangs', 'jumlah_baik', 'jumlah_rusak', 'jumlah_hilang'));

        return $pdf->download('laporan-barang.pdf');
    }
}
