@extends('layouts.app')

@section('title', 'Daftar User')
@section('header-title', 'Daftar User')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <a href="{{ route('users.create') }}" class="btn btn-primary fw-bold">
        + Tambah User
    </a>

    <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2" style="width: 250px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                class="form-control">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

@if ($users->count() > 0)
    <div class="table-responsive">
        <table class="table align-middle text-center table-hover">
            <thead style="background-color: #0d6efd; color: #fff;">
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
                    <tr class="align-middle">
                        {{-- Foto user --}}
                        <td>
                            @if ($user->photo && file_exists(public_path('photos/'.$user->photo)))
                                <img src="{{ asset('/photos' . $user->photo) }}" alt="{{ $user->name }}"
                                width="100" class="img-thumbnail">
                            @else
                                <small class="text-muted">Tidak ada gambar</small>
                            @endif
                        </td>

                        {{-- Username --}}
                        <td class="fw-bold text-primary">{{ $user->username }}</td>

                        {{-- Nama --}}
                        <td>{{ $user->name }}</td>

                        {{-- Email --}}
                        <td>{{ $user->email }}</td>

                        {{-- Role --}}
                        <td>
                            @if ($user->role == 1)
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-primary text-light">User</span>
                            @endif
                        </td>

                        {{-- Tanggal dibuat --}}
                        <td>{{ $user->created_at->format('d M Y') }}</td>

                        {{-- Tombol Aksi --}}
                        <td class="d-flex justify-content-center gap-1">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm fw-bold">Edit</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm fw-bold"
                                        onclick="return confirm('Apakah yakin ingin menghapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@else
    <div class="text-center py-5">
        <p class="text-muted fs-5">Tidak ada user ditemukan.</p>
    </div>
@endif
@endsection
