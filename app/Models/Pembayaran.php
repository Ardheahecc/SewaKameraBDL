<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pesanan_id',
        'detail_pesanan_id',
        'total_bayar',
        'denda',
        'jumlah',
        'status_pembayaran_denda', 
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
