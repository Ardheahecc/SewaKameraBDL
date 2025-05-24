<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Pesanan;
use App\Models\Keranjang;

class CheckoutController extends Controller
{
    public function getSnapToken(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;

        $pelangganId = auth('pelanggan')->id();
        $totalBayar = $this->hitungTotalKeranjang($pelangganId);

        $orderId = 'ORDER-' . uniqid();

        // Simpan dulu data pesanan ke database
        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelangganId,
            'tanggal_sewa' => $request->tanggal_sewa,
            'jam_sewa' => $request->jam_sewa,
            'total_bayar' => $totalBayar,
            'metode_bayar' => 'online',
            'status_pembayaran' => 'menunggu pembayaran',
            'status_sewa' => 'menunggu konfirmasi',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => auth('pelanggan')->user()->nama,
                'email' => auth('pelanggan')->user()->email ?? 'email@example.com',
            ],
            'callbacks' => [
                'finish' => route('checkout.konfirmasi'),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'pesanan' => $pesanan,
        ]);
    }

    public function offline(Request $request)
    {
        $pelangganId = auth('pelanggan')->id();
        $totalBayar = $this->hitungTotalKeranjang($pelangganId);

        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelangganId,
            'tanggal_sewa' => $request->tanggal_sewa,
            'jam_sewa' => $request->jam_sewa,
            'total_bayar' => $totalBayar,
            'metode_bayar' => 'offline',
            'status_pembayaran' => 'menunggu pembayaran',
            'status_sewa' => 'menunggu konfirmasi',
        ]);

        return response()->json(['success' => true]);
    }

    public function konfirmasi(Request $request)
    {
        $status = $request->status;
        return view('checkout.konfirmasi', compact('status'));
    }

}
