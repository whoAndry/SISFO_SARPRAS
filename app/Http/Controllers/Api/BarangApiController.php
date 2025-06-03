<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class BarangApiController extends Controller
{
    public function index()
    {
        $dataBarang = DataBarang::all()->map(function ($item) {
            // Perbaiki URL gambar agar bisa diakses oleh Flutter
            $item->gambar = $item->gambar
                ? asset('storage/' . $item->gambar) // Pastikan 'gambar' adalah path relatif di storage
                : null;
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $dataBarang
        ]);
    }
}

