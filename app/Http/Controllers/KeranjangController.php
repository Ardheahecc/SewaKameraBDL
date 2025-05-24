<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Midtrans\Snap;
use Midtrans\Config;


class KeranjangController extends Controller
{

    public function create()
    {
        return view('keranjang.create', [
            'title' => 'Tambah ke Keranjang'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'durasi' => 'required|in:6 jam,12 jam,24 jam',
            'jumlah_hari' => 'nullable|integer|min:1'
        ]);

        $validated['pelanggan_id'] = Auth::guard('pelanggan')->id();

        Keranjang::create($validated);

        return redirect()->back()->with('success', 'Barang berhasil dimasukkan ke keranjang!');
    }


    public function keranjang()
    {
        $user = Auth::guard('pelanggan')->user(); // Ambil pelanggan yang sedang login

        $keranjang = Keranjang::with('barang')
            ->where('pelanggan_id', $user->id)
            ->get();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($keranjang as $item) {
            if ($item->durasi === '6 jam') {
                $harga = $item->barang->harga_sewa_6_jam;
                $subtotal = $harga * $item->jumlah;
            } elseif ($item->durasi === '12 jam') {
                $harga = $item->barang->harga_sewa_12_jam;
                $subtotal = $harga * $item->jumlah;
            } else { // 24 jam
                $harga = $item->barang->harga_sewa_24_jam;
                $subtotal = $harga * $item->jumlah * $item->jumlah_hari;
            }
        
            $totalHarga += $subtotal;
        }

        return view('keranjang', [
            'user' => $user,
            'keranjang' => $keranjang,
            'totalHarga' => $totalHarga,
            // 'snapToken' => $snapToken,
        ]);
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);

        // Cek apakah keranjang milik pelanggan yang sedang login
        if ($keranjang->pelanggan_id !== Auth::guard('pelanggan')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

}
