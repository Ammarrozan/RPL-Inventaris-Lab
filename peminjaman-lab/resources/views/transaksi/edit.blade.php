@extends('layouts.main')

@section('content')
<h2>Edit Transaksi</h2>
<form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Status</label>
        <select name="id_status" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $transaksi->id_status == $status->id ? 'selected' : '' }}>
                    {{ $status->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tanggal Dikembalikan</label>
        <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ $transaksi->tanggal_dikembalikan }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
