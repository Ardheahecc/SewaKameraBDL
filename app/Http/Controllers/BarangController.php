<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function indexKamera()
    {
        $barang = Barang::where('kategori', 'kamera')->get();
        $kameraTersedia = $barang->sum('stok');

        return view('kamera', [
            'barang' => $barang,
            'kategori' => 'kamera',
            'title' => 'Unit Kamera',
            'kameraTersedia' => $kameraTersedia,
        ]);
    }

    public function indexAtribut()
    {
        $barang = Barang::where('kategori', 'atribut')->get();
        $atributTersedia = $barang->sum('stok');

        return view('atribut', [
            'barang' => $barang,
            'kategori' => 'atribut',
            'title' => 'Unit Atribut',
            'atributTersedia' => $atributTersedia,
        ]);
    }

    public function create()
    {
        return view('formBarang', [
            'title' => 'Tambah Barang',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:kamera,atribut',
            'tipe' => 'required|string|max:255',
            'harga_sewa_24_jam' => 'required|numeric',
            'harga_sewa_12_jam' => 'required|numeric',
            'harga_sewa_6_jam' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $namaFile);
            $validated['gambar'] = 'images/' . $namaFile;


        }


        Barang::create($validated);

        return redirect()->route($validated['kategori'] === 'kamera' ? 'kamera.index' : 'atribut.index')
            ->with('success', 'Barang berhasil disimpan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return view('formBarang', [
            'title' => 'Edit Barang',
            'barang' => $barang,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:kamera,atribut',
            'tipe' => 'required|string|max:255',
            'harga_sewa_24_jam' => 'required|numeric',
            'harga_sewa_12_jam' => 'required|numeric',
            'harga_sewa_6_jam' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar && file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $namaFile);

            $validated['gambar'] = 'images/' . $namaFile;
        }

        $barang->update($validated);

        return redirect()->route($validated['kategori'] === 'kamera' ? 'kamera.index' : 'atribut.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar && file_exists(public_path($barang->gambar))) {
            unlink(public_path($barang->gambar));
        }

        $kategori = $barang->kategori;
        $barang->delete();

        return redirect()->route($kategori === 'kamera' ? 'kamera.index' : 'atribut.index')
            ->with('success', 'Barang berhasil dihapus');
    }

    public function publicWelcome()
    {
        $barang = Barang::all();
        return view('welcome', compact('barang'));
    }

    public function katalogSemua()
    {
        $barang = Barang::all();
        $user = Auth::guard('pelanggan')->user(); // Ambil pelanggan yang sedang login

        return view('katalog', [
            'barang' => $barang,
            'user' => $user,
            'title' => 'Semua unit',
        ]);
    }
    public function katalogKamera()
    {
        $barang = Barang::where('kategori', 'kamera')->get();
        $user = Auth::guard('pelanggan')->user(); // Ambil pelanggan yang sedang login
        return view('katalog', [
            'barang' => $barang,
            'user' => $user,
            'kategori' => 'kamera',
            'title' => 'Unit kamera',
        ]);
    }
    public function katalogAtribut()
    {
        $barang = Barang::where('kategori', 'atribut')->get();
        $user = Auth::guard('pelanggan')->user(); // Ambil pelanggan yang sedang login
        return view('katalog', [
            'barang' => $barang,
            'user' => $user,
            'kategori' => 'atribut',
            'title' => 'Unit atribut',
        ]);
    }

    public function dashboard()
    {
        $kamera = Barang::where('kategori', 'kamera')->get();
        $atribut = Barang::where('kategori', 'atribut')->get();
        $pelanggan = Pelanggan::all();
        $jumlahPesanan = Pesanan::where('status_sewa', 'menunggu konfirmasi')->count();
        $pesanan = Pesanan::where('status_sewa', 'menunggu konfirmasi')->get();
        $penyewaan = Pesanan::where('status_sewa', 'aktif')->get();
        $jumlahPenyewaan = Pesanan::where('status_sewa', 'aktif')->count();

        return view('dashboard', [
            'kamera' => $kamera,
            'atribut' => $atribut,
            'pelanggan' => $pelanggan,
            'pesanan' => $pesanan,
            'penyewaan' => $penyewaan,
            'jumlahPesanan' => $jumlahPesanan,
            'jumlahPenyewaan' => $jumlahPenyewaan,
            'title' => 'Dashboard'
        ]);
    }
}
