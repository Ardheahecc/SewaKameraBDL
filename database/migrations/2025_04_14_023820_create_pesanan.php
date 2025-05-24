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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained(
                table: 'pelanggan', indexName: 'pesanan_pelanggan_id'
            );
            $table->date('tanggal_sewa');
            $table->time('jam_sewa');
            $table->decimal('total_bayar');
            $table->string('metode_bayar');
            $table->enum('status_pembayaran',['menunggu pembayaran','lunas'])->default('menunggu pembayaran');
            $table->enum('status_sewa', ['menunggu konfirmasi', 'aktif', 'selesai'])->default('menunggu konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
