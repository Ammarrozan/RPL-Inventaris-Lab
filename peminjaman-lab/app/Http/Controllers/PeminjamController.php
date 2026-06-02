<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\StatusMahasiswa;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::with(['barang', 'statusMahasiswa'])->get();
        return view('peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        $barangs  = Barang::where('stok_tersedia', '>', 0)->get();
        $statuses = StatusMahasiswa::all();
        return view('peminjam.create', compact('barangs', 'statuses'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nim'                 => 'required|string',
        'nama'                => 'required|string',
        'no_hp'               => 'required|string',
        'id_barang'           => 'required|exists:barang,id',
        'id_status_mahasiswa' => 'required|exists:status_mahasiswa,id',
    ]);

    Peminjam::create([
        'nim'                 => $request->nim,
        'nama'                => $request->nama,
        'no_hp'               => $request->no_hp,
        'id_barang'           => $request->id_barang,
        'id_status_mahasiswa' => $request->id_status_mahasiswa,
        'id_user'             => auth()->user()?->id,
        'created_by'          => auth()->user()?->id,
    ]);

    return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil ditambahkan');
}

    public function show(Peminjam $peminjam)
    {
        return view('peminjam.show', compact('peminjam'));
    }

    public function edit(Peminjam $peminjam)
    {
        $barangs  = Barang::all();
        $statuses = StatusMahasiswa::all();
        return view('peminjam.edit', compact('peminjam', 'barangs', 'statuses'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $peminjam->update([
            ...$request->only(['nim','nama','no_hp','id_barang','id_status_mahasiswa']),
            'updated_by' => auth()->user()?->id,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil diupdate');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();
        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil dihapus');
    }
}
