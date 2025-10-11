@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Dashboard')
@section('header-title', 'Dashboard')

@section('content')
<div class="container mt-4">

    {{-- Tampilkan isi berbeda tergantung role --}}
    @if (Auth::user()->role == 1)
        {{-- Halaman untuk admin --}}
        <h3>Halo, Admin</h3>
        <p>Selamat datang di dashboard admin. Di sini kamu bisa mengelola user, post, dan profil.</p>

        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-primary">Kelola User</a>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Kelola User</a>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kelola Post</a>
            <a href="{{ route('profile.index') }}" class="btn btn-info">Profil</a>
        </div>

    @elseif (Auth::user()->role == 2)
        {{-- Halaman untuk user biasa --}}
        <h3>Halo, {{ Auth::user()->username }} 👋</h3>
        <p>Selamat datang di dashboard kamu. Kamu bisa membuat dan melihat post, serta mengatur profilmu.</p>

        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Lihat Post</a>
            <a href="{{ route('profile.index') }}" class="btn btn-info">Profil</a>
        </div>
    @endif
</div>
@endsection


@push('scripts')
@endpush
