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

        return view('home', compact('totalKategori', 'totalBarang'));
    }
}
