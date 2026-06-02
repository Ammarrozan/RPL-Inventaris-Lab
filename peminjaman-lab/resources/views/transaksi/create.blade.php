@extends('layouts.main')

@section('content')
<h2>Tambah Transaksi</h2>
<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Peminjam</label>
        <select name="id_peminjam" class="form-control" required>
            @foreach($peminjams as $peminjam)
                <option value="{{ $peminjam->id }}">{{ $peminjam->nama }} - {{ $peminjam->nim }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tanggal Dipinjam</label>
        <input type="date" name="tanggal_dipinjam" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
