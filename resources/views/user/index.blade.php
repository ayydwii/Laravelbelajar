@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman User')
@section('header-title', 'Halaman User')

@section('content')
    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error message --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th style="width: 50px">No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Role</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->firstItem() - 1) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            @if($user->photo)
                                <img src="{{ asset('photos/'.$user->photo) }}" alt="Foto {{ $user->name }}" width="60">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>{{ $user->role == 1 ? 'Admin' : 'User' }}</td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm rounded">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm roundedpu">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection

@push('scripts')
@endpush
