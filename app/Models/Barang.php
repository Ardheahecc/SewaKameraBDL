<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'barang';

    // Menentukan kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'nama',
        'gambar',
        'tipe',
        'kategori',
        'harga_sewa_24_jam',
        'harga_sewa_12_jam',
        'harga_sewa_6_jam',
        'stok',
    ];

    // Menentukan kolom yang harus diformat ke dalam tipe data tertentu (optional, tergantung kebutuhan)
    protected $casts = [
        'stok' => 'integer',
    ];

    // Menggunakan mutator untuk menyimpan nama gambar dengan path lengkap

    // Accessor untuk status
    public function getStatusAttribute()
    {
        return $this->stok > 0 ? 'tersedia' : 'kosong';
    }

    // Relasi ke model Pesanan (One to Many)
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function keranjang() {
        return $this->hasMany(Keranjang::class);
    }
}
