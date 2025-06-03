<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataBarang;
use App\Models\User;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nama_peminjam',
        'barang_id',
        'jumlah',
        'status',
        'tanggal_pinjam',
        'tenggat_waktu',
    ];

    // Relasi ke barang (DataBarang)
    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'barang_id', 'id');
    }

    // Relasi ke pengguna (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
