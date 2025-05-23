<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;


class PengembalianController extends Controller
{
    public function index()
{
    $pengembalians = Pengembalian::orderBy('created_at', 'desc')->get();

    return view('pengembalian.index', compact('pengembalians'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'no' => 'required|unique:pengembalians',
        'nama_peminjam' => 'required|string',
        'nama_barang' => 'required|string',
        'jumlah' => 'required|integer',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'nullable|date',
        'kondisi_barang' => 'nullable|string',
        'aksi' => 'nullable|in:dikembalikan,terlambat',
    ]);

    $validated['status'] = $validated['aksi'] ?? 'pending';

    $pengembalian = Pengembalian::create($validated);

    return response()->json(['message' => 'Berhasil disimpan', 'data' => $pengembalian]);
}


}
