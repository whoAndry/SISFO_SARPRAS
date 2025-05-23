<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                         // Primary Key
            $table->string('name');              // Nama user
            $table->string('email')->unique();   // Email unik
            $table->string('password');          // Password terenkripsi
            $table->timestamps();                // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
