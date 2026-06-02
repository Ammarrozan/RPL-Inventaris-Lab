@extends('layouts.main')

@section('content')
<h2>Tambah Peminjam</h2>
<form action="{{ route('peminjam.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Barang</label>
        <select name="id_barang" class="form-control" required>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama }} (Stok: {{ $barang->stok_tersedia }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Status Mahasiswa</label>
        <select name="id_status_mahasiswa" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->nama }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
