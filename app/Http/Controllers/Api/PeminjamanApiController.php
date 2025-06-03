<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DataBarang;
use App\Models\User;

class PeminjamanApiController extends Controller
{
    // Simpan data peminjaman dari Flutter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_peminjam' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tenggat_waktu' => 'required|date',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // (Opsional) Cek stok barang
        $barang = DataBarang::find($validated['barang_id']);
        if ($barang->stok < $validated['jumlah']) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak mencukupi.',
            ], 422);
        }

        // Simpan data peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => $validated['user_id'],
            'nama_peminjam' => $validated['nama_peminjam'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tenggat_waktu' => $validated['tenggat_waktu'],
            'barang' => $validated['barang_id'],
            'jumlah' => $validated['jumlah'],
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diajukan.',
            'data' => $peminjaman
        ], 201);
    }

    // Ambil semua data peminjaman
    public function index()
    {
        $data = Peminjaman::with(['barang', 'user'])->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
