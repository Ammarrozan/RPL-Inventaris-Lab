@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <div class="page-title">Daftar Transaksi</div>
        <div class="page-subtitle">Kelola permintaan persetujuan, peminjaman, dan pengembalian alat lab.</div>
    </div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Transaksi
    </a>
</div>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
    {{-- Filter tabs --}}
    <div class="filter-tabs">
        <a href="?status=semua" class="filter-tab tab-blue {{ request('status') == 'semua' || !request('status') ? 'active' : '' }}">Semua Transaksi</a>
        <a href="?status=pending" class="filter-tab tab-yellow {{ request('status') == 'pending' ? 'active' : '' }}">Menunggu Approval</a>
        <a href="?status=dipinjam" class="filter-tab tab-blue2 {{ request('status') == 'dipinjam' ? 'active' : '' }}">Sedang Dipinjam</a>
        <a href="?status=selesai" class="filter-tab tab-green {{ request('status') == 'selesai' ? 'active' : '' }}">Selesai</a>
    </div>

    {{-- Search --}}
    <form action="{{ route('transaksi.index') }}" method="GET" style="max-width: 280px;" class="w-100">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <div class="search-group">
            <i class="bi bi-search"></i>
            <input type="text" name="cari" class="search-input" placeholder="Cari nama peminjam..." value="{{ request('cari') }}">
            @if(request('cari'))
                <a href="{{ route('transaksi.index', ['status' => request('status') ?? 'semua']) }}" class="search-clear">✕</a>
            @endif
        </div>
    </form>
</div>

<div class="card w-100 pt-fade-up">
    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-bordered mb-0 w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Alat</th>
                        <th class="text-center">Jml</th>
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
                    @php $status = $transaksi->status->nama ?? '-'; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><code style="background:#F0EFEA;color:#1A1A1A;padding:2px 6px;border-radius:4px;font-weight:700">{{ $transaksi->peminjam->barang->kode ?? '-' }}</code></td>
                        <td class="fw-bold">{{ $transaksi->details->barang->nama ?? '-' }}</td>
                        <td class="text-center fw-bold">{{ $transaksi->details->jumlah ?? '1' }}</td>
                        <td>{{ $transaksi->peminjam->nama ?? '-' }}</td>
                        <td>{{ $transaksi->peminjam->nim ?? '-' }}</td>
                        <td>{{ $transaksi->tanggal_dipinjam ?? '-' }}</td>
                        <td>{{ $transaksi->tanggal_dikembalikan ?? '-' }}</td>
                        <td>
                            @php
                                $badgeColor = match($status) {
                                    'Menunggu Approval' => '#FFE34D',
                                    'Dipinjam' => '#9DC8FF',
                                    'Selesai' => '#A8F0A8',
                                    'Ditolak' => '#FF9D9D',
                                    default => '#E8E6DD',
                                };
                            @endphp
                            <span style="background:{{ $badgeColor }};border:2px solid #1A1A1A;color:#1A1A1A;font-size:10px;font-weight:800;padding:3px 10px;border-radius:20px;text-transform:uppercase;display:inline-block;white-space:nowrap">
                                {{ $status }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($status == 'Menunggu Approval')
                                <form action="{{ route('transaksi.approve', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('transaksi.tolak', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin tolak?')">Tolak</button>
                                </form>
                            @elseif($status == 'Dipinjam')
                                <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info" onclick="return confirm('Tandai barang sudah dikembalikan?')">Kembalikan</button>
                                </form>
                            @else
                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
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

<style>
    .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
    .filter-tab {
        font-size: 11px; font-weight: 800; text-transform: uppercase;
        padding: 7px 14px; border-radius: 20px;
        border: 2px solid #1A1A1A; background: #fff; color: #1A1A1A;
        text-decoration: none; transition: all .15s;
        box-shadow: 2px 2px 0 #1A1A1A;
    }
    .filter-tab:hover { transform: translate(-1px,-1px); box-shadow: 3px 3px 0 #1A1A1A; }
    .tab-blue.active   { background: #9DC8FF; }
    .tab-yellow.active { background: #FFE34D; }
    .tab-blue2.active  { background: #7CD9C2; }
    .tab-green.active  { background: #A8F0A8; }

    .search-group {
        display: flex; align-items: center; gap: 8px;
        border: 3px solid #1A1A1A; border-radius: 6px;
        padding: 7px 12px; background: #fff;
    }
    .search-group i { color: #888; font-size: 13px; }
    .search-input {
        border: none; outline: none; font-size: 13px;
        font-family: inherit; width: 100%; background: transparent;
    }
    .search-clear {
        color: #FF4D4D; font-weight: 900; text-decoration: none;
        font-size: 13px; flex-shrink: 0;
    }

    .pt-fade-up { will-change: opacity, transform; animation-delay: .15s; }
</style>

@endsection
