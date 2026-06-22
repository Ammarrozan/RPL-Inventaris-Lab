<?php
namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\KondisiBarang;
use Illuminate\Http\Request;
class BarangController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Tampilkan semua barang agar admin bisa lihat yang stoknya habis/0
        $barangs = Barang::latest()->get();
        return view('barang.index', compact('barangs'));
    }
    public function create()
    {
        $kondisis = KondisiBarang::all();
        return view('barang.create', compact('kondisis'));
    }
    public function store(Request $request)
    {
        // PERBAIKAN: Tambah validasi untuk id_kondisi_barang
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok_total' => 'required|integer|min:0',
            'id_kondisi_barang' => 'required|exists:kondisi_barang,id',
        ]);
        $prefix = strtoupper(substr($request->nama, 0, 2));
        $lastBarang = Barang::where('kode', 'like', $prefix . '-%')
                            ->orderBy('id', 'desc')
                            ->first();
        if ($lastBarang) {
            $lastNumber = (int) substr($lastBarang->kode, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $kodeBarangFinal = $prefix . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        Barang::create([
            'kode'              => $kodeBarangFinal,
            'nama'              => $request->nama,
            'deskripsi'         => $request->deskripsi,
            'stok_total'        => $request->stok_total,
            'stok_tersedia'     => $request->stok_total,
            'id_kondisi_barang' => $request->id_kondisi_barang, // PERBAIKAN: Disamakan namanya
            'lokasi'            => $request->lokasi,
            'created_by'        => auth()->id(),
        ]);
        return redirect()->route('barang.index')->with('success', 'Barang baru berhasil ditambahkan dengan kode ' . $kodeBarangFinal);
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
        // Cek apakah barang ini punya peminjam dengan transaksi yang STATUSNYA MASIH AKTIF
        // (Menunggu Approval atau Dipinjam). Riwayat yang sudah Selesai/Ditolak tidak menghalangi hapus.
        $sedangDipinjam = \App\Models\Peminjam::where('id_barang', $barang->id)
            ->whereHas('transaksi', function ($query) {
                $query->whereHas('status', function ($q) {
                    $q->whereIn('nama', ['Menunggu Approval', 'Dipinjam']);
                });
            })
            ->exists();

        if ($sedangDipinjam) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang "' . $barang->nama . '" gagal dihapus! Masih ada peminjaman yang aktif (menunggu approval atau sedang dipinjam).');
        }

        // Kalau aman, jalankan soft delete / hard delete
        $namaBarang = $barang->nama;
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang "' . $namaBarang . '" berhasil dihapus');
    }
}
