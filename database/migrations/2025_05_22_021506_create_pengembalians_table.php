<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
    $table->id();
    $table->string('no')->unique();
    $table->string('nama_peminjam');
    $table->string('nama_barang');
    $table->integer('jumlah');
    $table->date('tanggal_pinjam');
    $table->date('tanggal_kembali')->nullable();
    $table->string('kondisi_barang')->nullable();
    $table->enum('aksi', ['dikembalikan', 'terlambat'])->nullable();
    $table->enum('status', ['pending', 'dikembalikan', 'terlambat'])->default('pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalians');
    }
};
