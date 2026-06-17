<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KondisiBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kondisis = KondisiBarang::all();
        return view('barang.create', compact('kondisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'             => 'nullable|string|unique:barang,kode',
            'nama'             => 'required|string',
            'deskripsi'        => 'nullable|string',
            'stok_total'       => 'required|integer|min:0',
            'stok_tersedia'    => 'required|integer|min:0',
            'id_kondisi_barang'=> 'required|exists:kondisi_barang,id',
            'lokasi'           => 'nullable|string',
        ]);

        Barang::create([
            'kode'              => $request->kode,
            'nama'              => $request->nama,
            'deskripsi'         => $request->deskripsi,
            'stok_total'        => $request->stok_total,
            'stok_tersedia'     => $request->stok_tersedia,
            'id_kondisi_barang' => $request->id_kondisi_barang,
            'lokasi'            => $request->lokasi,
            'created_by'        => auth()->user()?->id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kondisis = KondisiBarang::all();
        return view('barang.edit', compact('barang', 'kondisis'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode'              => 'nullable|string|unique:barang,kode,'.$barang->id,
            'nama'              => 'required|string',
            'stok_total'        => 'required|integer|min:0',
            'stok_tersedia'     => 'required|integer|min:0',
            'id_kondisi_barang' => 'required|exists:kondisi_barang,id',
        ]);

        $barang->update([
            'kode'              => $request->kode,  
            'nama'              => $request->nama,
            'deskripsi'         => $request->deskripsi,
            'stok_total'        => $request->stok_total,
            'stok_tersedia'     => $request->stok_tersedia,
            'id_kondisi_barang' => $request->id_kondisi_barang,
            'lokasi'            => $request->lokasi,
            'updated_by'        => auth()->user()?->id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
