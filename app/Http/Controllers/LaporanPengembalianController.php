<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('barang.kategori')->get();

        return view('laporan.pengembalian.index', compact('pengembalians'));
    }

    public function exportPdf()
    {
        $pengembalians = Pengembalian::with('barang.kategori')->get();

        $pdf = Pdf::loadView('laporan.pengembalian.pdf', compact('pengembalians'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_pengembalian.pdf');
    }
}
