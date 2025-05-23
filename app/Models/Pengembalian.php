<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama_peminjam',
        'nama_barang',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'kondisi_barang',
        'aksi',
        'status',
    ];
}
