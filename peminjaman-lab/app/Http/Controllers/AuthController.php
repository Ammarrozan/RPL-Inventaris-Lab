<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role; // Mengambil model Role
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function showLogin(){
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    // 2. Memproses data dari form daftar
    public function storeRegister(Request $request)
    {
        // Validasi data yang diinput
        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'      => 'required|string|unique:users,nim|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'nim.unique' => 'NIM ini sudah terdaftar!',
            'email.unique' => 'Email ini sudah digunakan!',
        ]);

        // 1. Ambil role mahasiswa (Langsung cari atau gunakan ID default 3 jika tidak ada)
        $role = \App\Models\Role::where('nama', 'like', 'mahasiswa')->first();
        $fixRoleId = $role ? $role->id : 3;

        // 2. Simpan data ke database
        User::create([
            'name'     => $request->name,
            'nim'      => $request->nim,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $fixRoleId,
        ]);

        // Kembalikan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun Mahasiswa berhasil dibuat! Silakan masuk.');

    }
}
