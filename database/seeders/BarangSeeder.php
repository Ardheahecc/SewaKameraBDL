<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        Barang::insert([
            [
                'nama' => 'Canon EOS 90D',
                'gambar' => 'kamera/canon-eos-90d.jpg',
                'tipe' => 'DSLR',
                'kategori' => 'kamera',
                'harga_sewa_24_jam' => 130000,
                'harga_sewa_12_jam' => 100000,
                'harga_sewa_6_jam' => 70000,
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nikon',
                'gambar' => 'kamera/nikon.jpg',
                'tipe' => 'DSLR',
                'kategori' => 'kamera',
                'harga_sewa_/24_jam' => 125000,
                'harga_sewa_/12_jam' => 95000,
                'harga_sewa_/6_jam' => 65000,
                'stok' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Tripod Toshiba',
                'gambar' => 'atribut/tripod-toshiba.jpg',
                'tipe' => 'Tripod',
                'kategori' => 'atribut',
                'harga_sewa_/24_jam' => 40000,
                'harga_sewa_/12_jam' => 25000,
                'harga_sewa_/6_jam' => 15000,
                'stok' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
