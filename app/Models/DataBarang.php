<?php

// app/Models/DataBarang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_barang',
        'kategori_barang_id',
        'gambar',
        'status',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
}

