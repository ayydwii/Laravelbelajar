@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman User')
@section('header-title', 'Halaman User')

@section('content')
    <h2>Tambah User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Username</label><br>
        <input type="text" name="username" value="{{ old('username') }}"><br><br>

        <label>Nama</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Simpan</button>
    </form>
@endsection

@push('scripts')
@endpush
