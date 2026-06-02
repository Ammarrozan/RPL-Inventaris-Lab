<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Peminjam;
use App\Models\StatusPeminjam;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['peminjam', 'status'])->get();
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

    return redirect()->route('transaksi.index')->with('success', 'Barang berhasil dikembalikan!');
}
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
