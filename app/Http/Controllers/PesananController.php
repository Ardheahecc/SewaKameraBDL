<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PesananController extends Controller
{
    public function semua()
    {
        $pesanan = Pesanan::with('pelanggan')->latest()->get();
        $jumlahPesanan = Pesanan::where('status_sewa', 'menunggu konfirmasi')->count();
        $jumlahPenyewaan = Pesanan::where('status_sewa', 'aktif')->count();
        return view('transaksi', [
            'title' => 'Semua transaksi',
            'pesanan' => $pesanan,
            'jumlahPesanan' => $jumlahPesanan,
            'jumlahPenyewaan' => $jumlahPenyewaan,
        ]);
    }

    public function index()
    {
        $pesanan = Pesanan::with('pelanggan') ->where('status_sewa', 'menunggu konfirmasi')->latest()->get();
        $jumlahPesanan = Pesanan::where('status_sewa', 'menunggu konfirmasi')->count();
        return view('daftarPesanan', [
            'title' => 'Pesanan',
            'pesanan' => $pesanan,
            'jumlahPesanan' => $jumlahPesanan,
        ]);
    }

    public function aktif()
    {
        $pesanan = Pesanan::with('pelanggan')
            ->where('status_sewa', 'aktif')
            ->latest()
            ->get();

        $jumlahPenyewaan = Pesanan::where('status_sewa', 'aktif')->count();

        return view('sewaAktif', [ // pastikan file view-nya: resources/views/sewaAktif.blade.php
            'title' => 'Penyewaan Aktif',
            'pesanan' => $pesanan,
            'jumlahPenyewaan' => $jumlahPenyewaan
        ]);
    }

    public function riwayat()
    {
        $pesanan = Pesanan::with('pelanggan')
            ->where('status_sewa', 'selesai')
            ->latest()
            ->get();

        return view('riwayat', [ // pastikan file view-nya: resources/views/sewaAktif.blade.php
            'title' => 'Riwayat Penyewaan',
            'pesanan' => $pesanan,
        ]);
    }

    public function show($id)
    {
        $pesanan = Pesanan::with([
            'pelanggan',
            'detailPesanan.barang' // pastikan relasi ini sudah ada di model
        ])->findOrFail($id);

        return view('detailOrder', [
            'title' => 'Detail Pesanan',
            'pesanan' => $pesanan,
        ]);
    }
    
    
    public function store(Request $request)
    {
        $userId = auth()->guard('pelanggan')->id();
        $keranjang = Keranjang::where('pelanggan_id', $userId)->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($keranjang as $item) {
                $barang = $item->barang;
                $jumlah = $item->jumlah;
                $durasi = $item->durasi;
                $hari = $item->jumlah_hari;

                $harga = match ($durasi) {
                    '6 jam' => $barang->harga_sewa_6_jam,
                    '12 jam' => $barang->harga_sewa_12_jam,
                    '24 jam' => $barang->harga_sewa_24_jam * $hari,
                    default => 0
                };

                $subtotal = $harga * $jumlah;
                $total += $subtotal;
            }

            $pesanan = Pesanan::create([
                'pelanggan_id'   => $userId,
                'tanggal_sewa'   => $request->tanggal_sewa,
                'jam_sewa'       => $request->jam_sewa,
                'total_bayar'    => $total, // ← WAJIB!
                'metode_bayar'   => $request->metode_bayar,
                'status_pembayaran' => $request->metode_bayar === 'bayar ditempat' ? 'menunggu pembayaran' : 'lunas',
                'status_sewa'             => 'menunggu konfirmasi', // ✅ status awal
            ]);

            foreach ($keranjang as $item) {
                $barang = $item->barang;
                $jumlah = $item->jumlah;
                $durasi = $item->durasi;
                $hari = $item->jumlah_hari;

                $harga = match ($durasi) {
                    '6 jam' => $barang->harga_sewa_6_jam,
                    '12 jam' => $barang->harga_sewa_12_jam,
                    '24 jam' => $barang->harga_sewa_24_jam * $hari,
                    default => 0
                };

                $subtotal = $harga * $jumlah;

                DetailPesanan::create([
                    'pesanan_id'    => $pesanan->id,
                    'barang_id'     => $item->barang_id,
                    'jumlah'        => $jumlah,
                    'durasi'        => $durasi,
                    'jumlah_hari'   => $hari,
                    'subtotal'      => $subtotal,
                ]);

                $barang->stok -= $jumlah;
                $barang->save();
            }

            Keranjang::where('pelanggan_id', $userId)->delete();

            DB::commit();

            return redirect()->route('pelanggan.pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Validasi hanya pesanan yang belum dikonfirmasi (menunggu)
        if ($pesanan->status_sewa !== 'menunggu konfirmasi') {
            return redirect()->back()->with('error', 'Pesanan sudah dikonfirmasi atau sudah selesai.');
        }

        $pesanan->status_sewa = 'aktif';
        $pesanan->save();

        // Panggil fungsi untuk menghitung keterlambatan
        $this->hitungKeterlambatan($pesanan);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    private function hitungKeterlambatan($pesanan)
    {
        $now = now();
        $mulaiSewa = $pesanan->created_at;

        foreach ($pesanan->detailPesanan as $detail) {
            // Hitung durasi sewa
            $durasi = match($detail->durasi) {
                '6 jam' => 6,
                '12 jam' => 12,
                '24 jam' => 24 * ($detail->jumlah_hari ?? 1),
                default => 0
            };

            // Waktu seharusnya dikembalikan
            $waktuKembali = $mulaiSewa->copy()->addHours($durasi);

            // Hitung selisih jika terlambat
            $terlambat = max(0, $now->diffInHours($waktuKembali, false) < 0 ? $now->diffInHours($waktuKembali) : 0);
            $denda = $terlambat * 15000;

            // Update nilai keterlambatan dan denda
            $detail->update([
                'jumlah_jam_terlambat' => $terlambat,
                'denda' => $denda
            ]);
        }
    }

    public function selesai($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Validasi: hanya bisa menyelesaikan pesanan yang aktif
        if ($pesanan->status_sewa !== 'aktif') {
            return redirect()->back()->with('error', 'Pesanan sudah dikonfirmasi atau sudah selesai.');
        }

        // Ambil semua detail pesanan terkait
        $detailPesanan = $pesanan->detailPesanan;

        // Tambahkan kembali stok barang sesuai jumlah
        foreach ($detailPesanan as $detail) {
            $barang = $detail->barang;
            $barang->stok += $detail->jumlah;
            $barang->save();
        }

        // Ubah status sewa menjadi selesai
        $pesanan->status_sewa = 'selesai';
        $pesanan->save();

        return redirect()->route('pesanan.aktif')->with('success', 'Pesanan selesai dan stok barang diperbarui.');
    }

    public function tolak($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Hanya boleh ditolak jika masih menunggu konfirmasi
        if ($pesanan->status_sewa !== 'menunggu konfirmasi') {
            return redirect()->back()->with('error', 'Hanya pesanan yang menunggu konfirmasi yang dapat ditolak.');
        }

        // Ambil semua detail pesanan terkait
        $detailPesanan = $pesanan->detailPesanan;

        // Kembalikan stok barang sesuai jumlah yang dipesan
        foreach ($detailPesanan as $detail) {
            $barang = $detail->barang;
            $barang->stok += $detail->jumlah;
            $barang->save();
        }

        // Hapus detail pesanan terkait (jika relasi cascade tidak aktif)
        $pesanan->detailPesanan()->delete();

        // Hapus pesanan
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditolak dan stok barang dikembalikan.');
    }

    public function batalkan($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Hanya boleh ditolak jika masih menunggu konfirmasi
        if ($pesanan->status_sewa !== 'menunggu konfirmasi') {
            return redirect()->back()->with('error', 'Hanya pesanan yang menunggu konfirmasi yang dapat ditolak.');
        }

        // Ambil semua detail pesanan terkait
        $detailPesanan = $pesanan->detailPesanan;

        // Kembalikan stok barang sesuai jumlah yang dipesan
        foreach ($detailPesanan as $detail) {
            $barang = $detail->barang;
            $barang->stok += $detail->jumlah;
            $barang->save();
        }

        // Hapus detail pesanan terkait (jika relasi cascade tidak aktif)
        $pesanan->detailPesanan()->delete();

        // Hapus pesanan
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditolak dan stok barang dikembalikan.');
    }

}
