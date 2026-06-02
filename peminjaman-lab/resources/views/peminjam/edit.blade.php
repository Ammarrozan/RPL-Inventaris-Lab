@extends('layouts.main')

@section('content')
<h2>Edit Peminjam</h2>
<form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" value="{{ $peminjam->nim }}" required>
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $peminjam->nama }}" required>
    </div>
    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ $peminjam->no_hp }}" required>
    </div>
    <div class="mb-3">
        <label>Barang</label>
        <select name="id_barang" class="form-control" required>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}" {{ $peminjam->id_barang == $barang->id ? 'selected' : '' }}>
                    {{ $barang->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Status Mahasiswa</label>
        <select name="id_status_mahasiswa" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $peminjam->id_status_mahasiswa == $status->id ? 'selected' : '' }}>
                    {{ $status->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
