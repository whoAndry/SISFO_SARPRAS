<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tenggat_waktu' => 'required|date|after_or_equal:tanggal_pinjam',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = DataBarang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Stok barang tidak mencukupi.'], 422);
            }
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Kurangi stok barang
        $barang->stok -= $request->jumlah;
        $barang->save();

        $peminjaman = Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tenggat_waktu' => $request->tenggat_waktu,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            // 'user_id' => auth()->id(), // aktifkan jika ada login
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Peminjaman berhasil ditambahkan.',
                'data' => $peminjaman
            ], 201);
        }

        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function updateStatus($id, $status)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($status === 'ditolak' && $peminjaman->status !== 'ditolak') {
            $barang = DataBarang::find($peminjaman->barang_id);
            if ($barang) {
                $barang->stok += $peminjaman->jumlah;
                $barang->save();
            }
        }

        $peminjaman->status = $status;
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $barang = DataBarang::find($peminjaman->barang_id);
        if ($barang && $peminjaman->status !== 'diterima') {
            $barang->stok += $peminjaman->jumlah;
            $barang->save();
        }

        $peminjaman->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
