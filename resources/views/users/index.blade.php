@extends('layouts.app')

@section('title', 'Daftar User')
@section('header-title', 'Daftar User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <a href="{{ route('users.create') }}" class="btn btn-success">
        + Tambah User
    </a>

    <form action="{{ route('users.index') }}" method="GET" class="d-flex" style="width: 250px; gap: 8px;">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari user..." class="form-control">
        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
    </form>
</div>

@if ($users->count() > 0)
    <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                {{-- Foto user --}}
                <td>
                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}"
                             alt="{{ $user->name }}" width="50" height="50"
                             class="rounded-circle object-fit-cover">
                    @else
                        <img src="https://via.placeholder.com/50"
                             alt="default photo" class="rounded-circle">
                    @endif
                </td>

                {{-- Username --}}
                <td>{{ $user->username }}</td>

                {{-- Nama --}}
                <td>{{ $user->name }}</td>

                {{-- Email --}}
                <td>{{ $user->email }}</td>

                {{-- Role --}}
                <td>
                    @if ($user->role == 1)
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                </td>

                {{-- Tanggal dibuat --}}
                <td>{{ $user->created_at->format('d M Y') }}</td>

                {{-- Tombol Aksi --}}
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('users.destroy', $user->id) }}"
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
@else
    <p class="text-center">Tidak ada user ditemukan.</p>
@endif
@endsection
