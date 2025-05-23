<?php

// database/migrations/xxxx_xx_xx_create_data_barangs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBarangsTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->foreignId('kategori_barang_id')->constrained()->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->enum('status', ['baik', 'rusak', 'hilang']);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_barangs');
    }
}
