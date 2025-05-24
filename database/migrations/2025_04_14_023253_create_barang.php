<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar');
            $table->string('tipe');
            $table->string('kategori');
            $table->decimal('harga_sewa_24_jam')->nullable();
            $table->decimal('harga_sewa_12_jam')->nullable();
            $table->decimal('harga_sewa_6_jam')->nullable();
            $table->string('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamera');
    }
};
