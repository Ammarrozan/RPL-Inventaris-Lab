@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Daftar Peminjam</h2>
    <a href="{{ route('peminjam.create') }}" class="btn btn-primary">Tambah Peminjam</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Barang</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjams as $index => $peminjam)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $peminjam->nim }}</td>
            <td>{{ $peminjam->nama }}</td>
            <td>{{ $peminjam->no_hp }}</td>
            <td>{{ $peminjam->barang->nama ?? '-' }}</td>
            <td>{{ $peminjam->statusMahasiswa->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('peminjam.destroy', $peminjam->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
