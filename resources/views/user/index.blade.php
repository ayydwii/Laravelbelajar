@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman User')
@section('header-title', 'Halaman User')

@section('content')
        <a href="{{ route('users.create') }}">Tambah User</a>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top:10px; width:100%;">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a> |
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center"></td>
            </tr>
        @endempty
    </table>
@endsection

@push('scripts')
@endpush
