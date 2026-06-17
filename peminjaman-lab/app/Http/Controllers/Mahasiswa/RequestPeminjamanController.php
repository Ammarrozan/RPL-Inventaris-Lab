<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailPeminjaman;
use App\Models\Transaksi;
use App\Models\Peminjam;
use App\Models\StatusPeminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestPeminjamanController extends Controller
{
    public function index()
    {
        $barangs = Barang::where('stok_tersedia', '>', 0)->with('kondisi')->get();
        return view('mahasiswa.barang', compact('barangs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_barang'        => 'required|exists:barang,id',
        'tanggal_dipinjam' => 'required|date',
        'jumlah'        => 'required|integer|min:1',
    ]);

    $user = Auth::user();
    $peminjam = Peminjam::firstOrCreate(
        [
            'id_user'             => $user->id,
            'nim'                 => $user->nim,
            'nama'                => $user->name,
            'no_hp'               => $user->no_hp ?? '-',
            'id_barang'           => $request->id_barang,
            'jumlah'              => $request->jumlah,
            'id_status_mahasiswa' => 1,
            'created_by'          => $user->id,
        ]
    );

    $statusMenunggu = StatusPeminjam::where('nama', 'Menunggu Approval')->first();

    // Buat transaksi
    $transaksi = Transaksi::create([
        'id_peminjam'      => $peminjam->id,
        'id_status'        => $statusMenunggu->id,
        'tanggal_dipinjam' => $request->tanggal_dipinjam,
        'created_by'       => $user->id,
    ]);
    // Kurangi stok tersedia
    $barang = Barang::find($request->id_barang);
    $barang->decrement('stok_tersedia', $request->jumlah);

    return redirect()->route('mahasiswa.riwayat')->with('success', 'Request peminjaman berhasil dikirim!');
}

    public function riwayat()
    {
        $user = Auth::user();
        $transaksis = Transaksi::where('created_by', $user->id)->with('status')->get();
        return view('mahasiswa.riwayat', compact('transaksis'));
    }
}
