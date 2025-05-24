<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Admin;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'password' => 'required|min:6', // Jangan lupa ada field 'password_confirmation' di form
            'no_hp' => 'required|string',
        ]);

        // Menciptakan pengguna baru
        $pelanggan = Pelanggan::create([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => bcrypt($validated['password']), // Meng-encrypt password
        ]);

        // Redirect atau login setelah registrasi sukses
        Auth::guard('pelanggan')->login($pelanggan);
        return redirect()->route('beranda'); // Ganti dengan route yang sesuai setelah login
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Pelanggan::where('nama', $credentials['nama'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::guard('pelanggan')->login($user);
            return redirect('/beranda')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'nama' => 'Nama atau password salah.',
        ])->onlyInput('nama');
    }

    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout(); // Logout dari guard pelanggan
        Session::flush();
        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    // =====Admin=====

    public function adminIndex()
    {
        $admin = Admin::all();
        return view('admin', [
            'title' => 'Daftar Admin',
            'admin' => $admin
        ]);
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function adminDestroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect('/admin')->with('success', 'Admin berhasil dihapus.');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
            return redirect('/dashboard')->with('success', 'Login admin berhasil!');
        }
        
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout(); // Logout user (dalam hal ini admin)
        Session::flush(); // Hapus semua session

        return redirect()->route('loginAdmin')->with('success', 'Anda berhasil logout.');
    }

    public function beranda()
    {
        $barang = Barang::all(); // ambil 8 barang terbaru
        $user = Auth::guard('pelanggan')->user(); // Ambil pelanggan yang sedang login

        if (!$user) {
            abort(403, 'Akses ditolak, login terlebih dahulu.');
        }

        return view('beranda', [
            'user' => $user,
            'barang' => $barang,
        ]);
    }
}
