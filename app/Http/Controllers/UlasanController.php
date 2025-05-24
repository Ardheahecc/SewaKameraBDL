<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use App\Models\Ulasan;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UlasanController extends Controller
{

    public function index()
    {
        $ulasan = Ulasan::with('pelanggan')->latest()->get(); // ambil semua ulasan terbaru dengan relasi nama pelanggan
        return view('ulasan', [
            'ulasan' => $ulasan,
            'title' => 'Ulasan Pengguna',
        ]);
    }

    public function show($id)
    {
        $ulasan = Ulasan::with('pelanggan')->findOrFail($id);

        return view('detailUlasan', [
            'title' => 'Detail Ulasan',
            'ulasan' => $ulasan,
            'pelanggan' => $ulasan->pelanggan,
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pelanggan,id',
            'ulasan' => 'required|string|max:1000',
        ]);

        Ulasan::create([
            'pelanggan_id' => $request->id,
            'isi' => $request->ulasan,
        ]);

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim.');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);

        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
