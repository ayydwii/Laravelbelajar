@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Password (biarkan kosong jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <!-- Foto Profil -->
    <div class="text-center mb-3">
        <label for="photo" style="cursor: pointer;">
            <img
                id="photo-preview"
                src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-user.png') }}"
                alt="Foto Profil"
                width="120" height="120"
                class="rounded-circle object-fit-cover shadow-sm">
        </label>
        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;">
        <p class="text-muted small">Klik foto untuk mengubah</p>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
