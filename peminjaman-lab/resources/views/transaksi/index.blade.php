@extends('layouts.main')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Daftar Transaksi</h2>
            <p class="text-muted mb-0">Kelola permintaan persetujuan, peminjaman, dan pengembalian alat lab.</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Transaksi
        </a>
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
        <div class="btn-group shadow-sm" role="group" aria-label="Filter Status">
            <a href="?status=semua" class="btn btn-sm btn-outline-primary {{ request('status') == 'semua' || !request('status') ? 'active' : '' }}">Semua Transaksi</a>
            <a href="?status=pending" class="btn btn-sm btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">Menunggu Approval</a>
            <a href="?status=dipinjam" class="btn btn-sm btn-outline-info {{ request('status') == 'dipinjam' ? 'active' : '' }}">Sedang Dipinjam</a>
            <a href="?status=selesai" class="btn btn-sm btn-outline-success {{ request('status') == 'selesai' ? 'active' : '' }}">Selesai</a>
        </div>

        <form action="{{ route('transaksi.index') }}" method="GET" style="max-width: 280px;" class="w-100">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div class="input-group input-group-sm">
                <input type="text" name="cari" class="form-control form-control-sm" placeholder="🔍 Cari nama peminjam..." value="{{ request('cari') }}">
                @if(request('cari'))
                    <a href="{{ route('transaksi.index', ['status' => request('status') ?? 'semua']) }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">✕</a>
                @endif
            </div>
        </form>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary sticky-top">
                        <tr>
                            <th class="py-3 px-3">No</th>
                            <th>Kode</th>
                            <th>Alat</th>
                            <th>Nama Peminjam</th>
                            <th>NIM</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $index => $transaksi)
                        <tr>
                            <td class="px-3 fw-medium text-muted">{{ $index + 1 }}</td>
                            <td><code class="text-dark">{{ $transaksi->peminjam->barang->kode ?? '-' }}</code></td>
                            <td class="fw-semibold text-dark">{{ $transaksi->details->barang->nama ?? '-' }}</td>
                            <td>{{ $transaksi->peminjam->nama ?? '-' }}</td>
                            <td class="text-muted">{{ $transaksi->peminjam->nim ?? '-' }}</td>
                            <td>{{ $transaksi->tanggal_dipinjam ?? '-' }}</td>
                            <td>{{ $transaksi->tanggal_dikembalikan ?? '-' }}</td>

                            <td>
                                @php $status = $transaksi->status->nama ?? '-'; @endphp
                                @if($status == 'Menunggu Approval')
                                    <span class="badge bg-warning text-dark px-2.5 py-1.5 rounded-pill">Menunggu Approval</span>
                                @elseif($status == 'Dipinjam')
                                    <span class="badge bg-info text-white px-2.5 py-1.5 rounded-pill">Dipinjam</span>
                                @elseif($status == 'Selesai')
                                    <span class="badge bg-success text-white px-2.5 py-1.5 rounded-pill">Selesai</span>
                                @else
                                    <span class="badge bg-secondary text-white px-2.5 py-1.5 rounded-pill">{{ $status }}</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($status == 'Menunggu Approval')
                                    <form action="{{ route('transaksi.approve', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success px-3 shadow-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('transaksi.tolak', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger px-3 shadow-sm" onclick="return confirm('Yakin tolak?')">Tolak</button>
                                    </form>

                                @elseif($status == 'Dipinjam')
                                    <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-info text-white px-3 shadow-sm" onclick="return confirm('Tandai barang sudah dikembalikan?')">Kembalikan</button>
                                    </form>

                                @else
                                    <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning text-dark px-2.5">Edit</a>
                                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger px-2.5" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
