@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Daftar Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stok Total</th>
            <th>Stok Tersedia</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barangs as $index => $barang)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $barang->nama }}</td>
            <td>{{ $barang->stok_total }}</td>
            <td>{{ $barang->stok_tersedia }}</td>
            <td>{{ $barang->kondisi->nama ?? '-' }}</td>
            <td>{{ $barang->lokasi ?? '-' }}</td>
            <td>
                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
