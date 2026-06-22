@extends('mahasiswa.layout')

@section('content')

<style>
    .page-title-custom {
        font-size: 24px;
        font-weight: 900;
        color: #1A1A1A;
        text-transform: uppercase;
        letter-spacing: -.5px;
        margin-bottom: 4px;
    }
    .page-subtitle-custom {
        font-size: 13px;
        color: #666;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .table-wrapper {
        background: #fff;
        border: 3px solid #1A1A1A;
        border-radius: 8px;
        box-shadow: 5px 5px 0 #1A1A1A;
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    .custom-table th {
        background-color: #1A1A1A;
        color: #FFE34D;
        font-weight: 800;
        padding: 13px 18px;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .custom-table td {
        padding: 13px 18px;
        border-bottom: 2px solid #F0EFEA;
        color: #1A1A1A;
        font-size: 13px;
        font-weight: 600;
        vertical-align: middle;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status badge mono-pop */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50rem;
        font-size: 10px;
        font-weight: 800;
        text-align: center;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        border: 2px solid #1A1A1A;
    }

    .status-dipinjam { background-color: #9DC8FF; color: #1A1A1A; }
    .status-menunggu { background-color: #FFE34D; color: #1A1A1A; }
    .status-selesai  { background-color: #A8F0A8; color: #1A1A1A; }
    .status-ditolak  { background-color: #FF9D9D; color: #1A1A1A; }
    .status-terlambat{ background-color: #1A1A1A; color: #FF9D9D; }
    .status-default  { background-color: #E8E6DD; color: #1A1A1A; }

    /* ── Animasi pop-up ── */
    .pt-fade-up {
        opacity: 0; transform: translateY(24px);
        animation: ptFadeUp 0.5s cubic-bezier(.2,.8,.2,1) forwards;
        animation-delay: .15s; will-change: opacity, transform;
    }
    @keyframes ptFadeUp { to { opacity: 1; transform: translateY(0); } }
</style>

<div class="page-header pt-fade-up">
    <div class="page-title-custom">Riwayat Peminjaman</div>
    <div class="page-subtitle-custom">{{ $transaksis->count() ?? 0 }} transaksi tercatat</div>
</div>

<div class="table-wrapper pt-fade-up" style="animation-delay:.22s">
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Kuantitas</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $index => $transaksi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $transaksi->details->barang->nama ?? '-' }}</td>
                <td>{{ $transaksi->details->jumlah ?? '0' }} unit</td>
                <td>{{ $transaksi->tanggal_dipinjam ?? '-' }}</td>
                <td>{{ $transaksi->tanggal_dikembalikan ?? '-' }}</td>
                <td>
                    @php $status = $transaksi->status->nama ?? '-'; @endphp
                    <span class="status-badge
                        {{ $status == 'Menunggu Approval' ? 'status-menunggu' : '' }}
                        {{ $status == 'Dipinjam' ? 'status-dipinjam' : '' }}
                        {{ $status == 'Selesai' ? 'status-selesai' : '' }}
                        {{ $status == 'Ditolak' ? 'status-ditolak' : '' }}
                        {{ $status == 'Terlambat' ? 'status-terlambat' : '' }}
                        {{ !in_array($status, ['Menunggu Approval', 'Dipinjam', 'Selesai', 'Ditolak', 'Terlambat']) ? 'status-default' : '' }}
                    ">{{ $status }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 30px; color: #888; font-weight: 600;">
                    Belum ada riwayat peminjaman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
