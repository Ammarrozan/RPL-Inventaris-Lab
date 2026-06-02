@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Daftar Users</h2>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->no_hp ?? '-' }}</td>
            <td>{{ $user->role->nama ?? '-' }}</td>
            <td>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
