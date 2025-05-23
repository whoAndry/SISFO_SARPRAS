<?php

// app/Http/Controllers/DataBarangController.php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index(Request $request)
    {
        // Query awal dengan relasi kategori
        $query = DataBarang::with('kategori');

        // Filter nama barang jika ada input pencarian
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('kategori_id')) {
            $query->where('kategori_barang_id', $request->kategori_id);
        }

        // Ambil hasil pencarian
        $dataBarangs = $query->get();

        // Ambil semua kategori untuk dropdown filter
        $kategoriBarangs = KategoriBarang::all();

        return view('data_barang.index', compact('dataBarangs', 'kategoriBarangs'));
    }

    public function create()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('data_barang.create', compact('kategoriBarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:baik,rusak,hilang',
            'stok' => 'required|integer|min:0',
        ]);

        $data = $request->only(['nama_barang', 'kategori_barang_id', 'status', 'stok']);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar_barang', 'public');
            $data['gambar'] = $gambar;
        }

        DataBarang::create($data);

        return redirect()->route('data_barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(DataBarang $dataBarang)
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('data_barang.edit', compact('dataBarang', 'kategoriBarangs'));
    }

    public function update(Request $request, DataBarang $dataBarang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:baik,rusak,hilang',
            'stok' => 'required|integer|min:0',
        ]);

        $data = $request->only(['nama_barang', 'kategori_barang_id', 'status', 'stok']);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar_barang', 'public');
            $data['gambar'] = $gambar;
        }

        $dataBarang->update($data);

        return redirect()->route('data_barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(DataBarang $dataBarang)
    {
        $dataBarang->delete();
        return redirect()->route('data_barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
