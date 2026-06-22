<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KondisiBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('kode', 'asc')->get();
        $jenisBarang = Barang::distinct('nama')->count();
        $totalStok = Barang::sum('stok_total');
        $stokTersedia = Barang::sum('stok_tersedia');

        return view('barang.index', compact('barangs', 'jenisBarang', 'totalStok', 'stokTersedia'));
    }

    public function create()
    {
        // Mengambil data kondisi barang untuk pilihan select-option di form
        $kondisis = KondisiBarang::all();
        return view('barang.create', compact('kondisis'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'nama' => 'required|string',
            'stok_total' => 'required|integer|min:1',
            'id_kondisi_barang' => 'required',
            'lokasi' => 'required',
        ]);

        // 2. Ambil 2 huruf pertama dari nama barang sebagai Prefix (Contoh: "Router" -> "RO")
        $prefix = strtoupper(substr($request->nama, 0, 2));

        // 3. Cari kode terakhir di database yang mirip dengan prefix tersebut
        $lastBarang = Barang::where('kode', 'LIKE', $prefix . '-%')
                        ->orderBy('kode', 'desc')
                        ->first();

        $lastNumber = 0;
        if ($lastBarang) {
            $lastNumber = (int) str_replace($prefix . '-', '', $lastBarang->kode);
        }

        // 4. Ambil jumlah stok yang mau diinput oleh aslab
        $jumlahInput = $request->stok_total;

        for ($i = 1; $i <= $jumlahInput; $i++) {
            $nextNumber = $lastNumber + $i;
            $kodeOtomatis = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Insert ke database per 1 unit barang
            Barang::create([
                'kode' => $kodeOtomatis,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'stok_total' => 1,
                'stok_tersedia' => 1,
                'id_kondisi_barang' => $request->id_kondisi_barang,
                'lokasi' => $request->lokasi,
            ]);
        }

        return redirect()->route('barang.index')->with('success', $jumlahInput . ' unit ' . $request->nama . ' berhasil didaftarkan otomatis!');
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
            'updated_by'        => auth()->id(),
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $sedangDipinjam = \App\Models\Peminjam::where('id_barang', $barang->id)
            ->whereHas('transaksi', function ($query) {
                $query->whereHas('status', function ($q) {
                    $q->whereIn('nama', ['Menunggu Approval', 'Dipinjam']);
                });
            })
            ->exists();

        if ($sedangDipinjam) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang "' . $barang->nama . '" gagal dihapus! Masih ada peminjaman yang aktif.');
        }

        $namaBarang = $barang->nama;
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang "' . $namaBarang . '" berhasil dihapus');
    }

    public function cetakBarcode(Request $request)
{
    $ids = $request->input('barang_id');

    if (empty($ids)) {
        return redirect()->back()->with('error', 'Silakan pilih minimal satu barang untuk dicetak barcodenya!');
    }

    $barangs = Barang::whereIn('id', $ids)->orderBy('kode', 'asc')->get();

    // Otomatis mendeteksi class mana yang tersedia di folder vendor lu
    if (class_exists('\Picqer\Barcode\BarcodeGeneratorPng')) {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPng();
    } elseif (class_exists('\Picqer\Barcode\BarcodeGeneratorPNG')) {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
    } else {
        // Jika dua-duanya tetep gak ketemu, dia bakal ngasih pesen error rapi di halaman dashboard
        return redirect()->route('barang.index')->with('error', 'Library Barcode belum terinstall dengan benar di folder project ini. Silakan jalankan "composer require picqer/php-barcode-generator" di terminal VS Code!');
    }

    return view('barang.cetak', compact('barangs', 'generator'));
    }
}
