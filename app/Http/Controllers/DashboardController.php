<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\KategoriBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKategori = KategoriBarang::count();
        $totalBarang = DataBarang::count(); // total data barang (bukan stok)

        // Hitung jumlah barang berdasarkan kondisi
        $barangBaik = DataBarang::where('status', 'baik')->count();
        $barangRusak = DataBarang::where('status', 'rusak')->count();
        $barangHilang = DataBarang::where('status', 'hilang')->count();

        return view('home', compact(
            'totalKategori',
            'totalBarang',
            'barangBaik',
            'barangRusak',
            'barangHilang'
        ));
    }
}
