<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index() 
    {
        $peminjamans = Peminjaman::all();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function updateStatus($id, $status)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $status;
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}
