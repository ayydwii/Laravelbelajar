@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <a href="{{ route('users.create') }}" class="btn btn-success">
        + Tambah User
    </a>

    <form action="{{ route('users.index') }}" method="GET" class="d-flex" style="width: 250px; gap: 8px;">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari user...">
        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
    </form>
</div>

@if ($users->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@else
    <p>Tidak ada user ditemukan.</p>
@endif
@endsection
