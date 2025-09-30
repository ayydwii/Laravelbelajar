@extends('layouts.app')

@section('title', 'Edit User')
@section('header-title', 'Edit User')

@section('content')
    <h4>Edit User</h4>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>Foto Lama</label><br>
            @if($user->photo)
                <img src="{{ asset('photos/'.$user->photo) }}" alt="Foto User" width="80" class="mb-2">
            @else
                <p>- Tidak ada foto -</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
