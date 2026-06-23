<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Peminjam;
use App\Models\StatusPeminjam;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        // 1. Buat query dasar beserta seluruh relasinya
        $query = Transaksi::with(['peminjam.user', 'peminjam.barang', 'status']);

        // 2. TANGKAP PARAMETER DARI URL (?status=... & cari=...)
        $statusUrl = $request->query('status');
        $cariUrl = $request->query('cari');

        // 3. Logika Filter Berdasarkan Status (Yang sudah aman sebelumnya)
        if ($statusUrl && $statusUrl != 'semua') {
            $query->whereHas('status', function($q) use ($statusUrl) {
                if ($statusUrl == 'pending') {
                    $q->where('nama', 'Menunggu Approval');
                } elseif ($statusUrl == 'dipinjam') {
                    $q->where('nama', 'Dipinjam');
                } elseif ($statusUrl == 'selesai') {
                    $q->where('nama', 'Selesai');
                }
            });
        }

        // 4. LOGIKA TAMBAHAN: Filter Pencarian Nama Peminjam
        if ($cariUrl) {
            $query->whereHas('peminjam', function($q) use ($cariUrl) {
                // Mencari nama yang mirip/mengandung kata kunci yang diketik user
                $q->where('nama', 'like', '%' . $cariUrl . '%');
            });
        }

        // 5. Eksekusi query final dan kirim hasilnya ke View
        $transaksis = $query->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $peminjams = Peminjam::all();
        $statuses  = StatusPeminjam::all();
        return view('transaksi.create', compact('peminjams', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjam'      => 'required|exists:peminjam,id',
            'tanggal_dipinjam' => 'required|date',
        ]);

        $statusDipinjam = StatusPeminjam::where('nama', 'Dipinjam')->first();

        Transaksi::create([
            'id_peminjam'      => $request->id_peminjam,
            'id_status'        => $statusDipinjam->id,
            'tanggal_dipinjam' => $request->tanggal_dipinjam,
            'created_by'       => auth()->user()?->id,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $statuses = StatusPeminjam::all();
        return view('transaksi.edit', compact('transaksi', 'statuses'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $transaksi->update([
            'id_status'            => $request->id_status,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'updated_by'           => auth()->user()?->id,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    public function approve($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $status = \App\Models\StatusPeminjam::where('nama', 'Dipinjam')->first();
    $transaksi->update([
        'id_status'  => $status->id,
        'updated_by' => auth()->user()?->id,
    ]);
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diapprove!');
}

    public function tolak($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $status = \App\Models\StatusPeminjam::where('nama', 'Ditolak')->first();
    $transaksi->update([
        'id_status'  => $status->id,
        'updated_by' => auth()->user()?->id,
    ]);
    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditolak!');
}
    public function kembalikan($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $status = StatusPeminjam::where('nama', 'Selesai')->first();
    $transaksi->update([
        'id_status'            => $status->id,
        'tanggal_dikembalikan' => now()->toDateString(),
        'updated_by'           => auth()->user()?->id,

    ]);

        $peminjam = $transaksi->peminjam;
    if ($peminjam && $peminjam->barang) {
        $peminjam->barang->increment('stok_tersedia', $peminjam->jumlah);
    }


    return redirect()->route('transaksi.index')->with('success', 'Barang berhasil dikembalikan!');
}
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
