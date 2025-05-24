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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained(
                table: 'pesanan', indexName: 'pembayaran_pesanan_id'
            );
            $table->foreignId('detail_pesanan_id')->constrained(
                table: 'detail_pesanan', indexName: 'pembayaran_detail_id'
            );
            $table->decimal('total_bayar');
            $table->decimal('denda')->nullable();
            $table->decimal('jumlah');
            $table->enum('status_pembayaran_denda',['menunggu_pembayaran','lunas', 'tidak_ada_denda'])->default('tidak_ada_denda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
