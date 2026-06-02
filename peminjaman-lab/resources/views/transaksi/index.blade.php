@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Daftar Transaksi</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Transaksi</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $index => $transaksi)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $transaksi->peminjam->nama ?? '-' }}</td>
            <td>{{ $transaksi->details->barang->nama ?? '-' }}</td>
            <td>{{ $transaksi->tanggal_dipinjam }}</td>
            <td>{{ $transaksi->tanggal_dikembalikan ?? '-' }}</td>
            <td>{{ $transaksi->status->nama ?? '-' }}</td>
            <td>
                @php $status = $transaksi->status->nama ?? '-'; @endphp

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
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
