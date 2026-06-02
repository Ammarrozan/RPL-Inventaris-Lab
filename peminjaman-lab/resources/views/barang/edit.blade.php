@extends('layouts.main')

@section('content')
<h2>Edit Barang</h2>
<form action="{{ route('barang.update', $barang->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $barang->deskripsi }}</textarea>
    </div>
    <div class="mb-3">
        <label>Stok Total</label>
        <input type="number" name="stok_total" class="form-control" value="{{ $barang->stok_total }}" required>
    </div>
    <div class="mb-3">
        <label>Stok Tersedia</label>
        <input type="number" name="stok_tersedia" class="form-control" value="{{ $barang->stok_tersedia }}" required>
    </div>
    <div class="mb-3">
        <label>Kondisi</label>
        <select name="id_kondisi_barang" class="form-control" required>
            @foreach($kondisis as $kondisi)
                <option value="{{ $kondisi->id }}" {{ $barang->id_kondisi_barang == $kondisi->id ? 'selected' : '' }}>
                    {{ $kondisi->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" value="{{ $barang->lokasi }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
