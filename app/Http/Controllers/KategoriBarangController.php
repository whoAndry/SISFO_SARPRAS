<?php

// app/Http/Controllers/KategoriBarangController.php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari input
        $search = $request->input('search');

        // Ambil data kategori, dengan filter pencarian jika ada
        $kategoriBarangs = KategoriBarang::when($search, function ($query, $search) {
            return $query->where('nama_kategori', 'like', '%' . $search . '%');
        })->get();

        return view('kategori_barang.index', compact('kategoriBarangs'));
    }

    public function create()
    {
        return view('kategori_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        KategoriBarang::create($request->only('nama_kategori'));

        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        return view('kategori_barang.edit', compact('kategoriBarang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategoriBarang->update($request->only('nama_kategori'));

        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        $kategoriBarang->delete();

        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
