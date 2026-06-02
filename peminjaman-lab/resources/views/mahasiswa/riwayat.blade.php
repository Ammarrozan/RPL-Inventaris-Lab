@extends('mahasiswa.layout')

@section('content')
<h2 class="mb-4">Riwayat Peminjaman</h2>

<table class="table table-bordered">
    <thead class="table-dark">
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
            <td>
                {{ $transaksi->details->barang->nama }}<br>
            </td>
            <td>
                {{ $transaksi->details->jumlah }} unit<br>
            </td>
            <td>{{ $transaksi->tanggal_dipinjam ?? '-' }}</td>
            <td>{{ $transaksi->tanggal_dikembalikan ?? '-' }}</td>
            <td>
                @php $status = $transaksi->status->nama ?? '-'; @endphp
                <span class="badge
                    {{ $status == 'Menunggu Approval' ? 'bg-warning' : '' }}
                    {{ $status == 'Dipinjam' ? 'bg-primary' : '' }}
                    {{ $status == 'Selesai' ? 'bg-success' : '' }}
                    {{ $status == 'Ditolak' ? 'bg-danger' : '' }}
                    {{ $status == 'Terlambat' ? 'bg-dark' : '' }}
                ">{{ $status }}</span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada riwayat peminjaman</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
