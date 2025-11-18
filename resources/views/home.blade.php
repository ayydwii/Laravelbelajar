@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Dashboard')
@section('header-title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="dashboard-card">
        {{-- Tampilkan isi berbeda tergantung role --}}
        @if (Auth::user()->role == 1)
            {{-- Halaman untuk admin --}}
            <h3>Halo, Admin</h3>
            <p>Selamat datang di dashboard admin. Di sini kamu bisa mengelola user, post, dan profil.</p>

            <div class="mt-4 d-flex flex-wrap gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-primary fw-bold">Kelola User</a>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary fw-bold">Kelola Post</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary fw-bold">Profil</a>
            </div>

        @elseif (Auth::user()->role == 2)
            {{-- Halaman untuk user biasa --}}
            <h3>Halo, {{ Auth::user()->username }} 👋</h3>
            <p>Selamat datang di dashboard kamu. Kamu bisa membuat dan melihat post, serta mengatur profilmu.</p>

            <div class="mt-4 d-flex flex-wrap gap-2">
                <a href="{{ route('posts.index') }}" class="btn btn-primary fw-bold">Lihat Post</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary fw-bold">Profil</a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@endpush
