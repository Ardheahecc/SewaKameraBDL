<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'pelanggan_id',
        'barang_id',
        'jumlah',
        'durasi',
        'jumlah_hari',
    ];

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class);
    }
    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}
