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
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained(
                table: 'pesanan', indexName: 'detail_pesanan_id'
            );
            $table->foreignId('barang_id')->constrained(
                table: 'barang', indexName: 'detail_barang_id'
            )->onDelete('cascade');
            $table->integer('jumlah');
            $table->enum('durasi', ['6 jam', '12 jam', '24 jam']);
            $table->integer('jumlah_hari')->nullable(); // hanya untuk 24 jam
            $table->decimal('subtotal');
            $table->integer('jumlah_jam_terlambat')->nullable();
            $table->decimal('denda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
