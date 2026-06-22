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
    // 1. Validasi inputan form
    $request->validate([
        'nama' => 'required|string',
        'stok_total' => 'required|integer|min:1',
        'id_kondisi_barang' => 'required',
        'lokasi' => 'required',
    ]);

    // 2. Ambil 2 huruf pertama dari nama barang sebagai Prefix (Contoh: "Router" -> "RO")
    $prefix = strtoupper(substr($request->nama, 0, 2)); // Menghasilkan "RO" atau "LA"

    // 3. Cari kode terakhir di database yang mirip dengan prefix tersebut (Contoh: mencari "RO-")
    $lastBarang = \App\Models\Barang::where('kode', 'LIKE', $prefix . '-%')
                    ->orderBy('kode', 'desc')
                    ->first();

    $lastNumber = 0;
    if ($lastBarang) {
        // Jika ketemu "RO-010", ambil angkanya saja "010" lalu ubah jadi integer (10)
        $lastNumber = (int) str_replace($prefix . '-', '', $lastBarang->kode);
    }

    // 4. Ambil jumlah stok yang mau diinput oleh aslab
    $jumlahInput = $request->stok_total;

    // 5. LOOPING: Simpan ke database satu per satu unit barang
    for ($i = 1; $i <= $jumlahInput; $i++) {
        $nextNumber = $lastNumber + $i; // Menghitung nomor urut selanjutnya

        // Gabungkan kembali menjadi format kode otomatis (Contoh: RO-001)
        $kodeOtomatis = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Insert ke database per 1 unit barang
        \App\Models\Barang::create([
            'kode' => $kodeOtomatis,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok_total' => 1,       // Set 1 karena dilacak per biji
            'stok_tersedia' => 1,    // Set 1 karena unit baru ini langsung tersedia
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
