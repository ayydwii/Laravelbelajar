@extends('layouts.app')

@section('title', $title)
@section('header-title', $headerTitle)

@section('content')
    <div class="card p-4 shadow-sm">
        <h4>Selamat Datang, {{ $user->name ?? 'Pengguna' }} 👋</h4>
        <p>Ini adalah halaman dashboard admin. Silakan pilih menu di sidebar untuk mengelola data.</p>

        <div class="mt-4">
            <h5>Ringkasan</h5>
            <ul>
                <li>Total User: {{ \App\Models\User::count() }}</li>
                <li>Email Login: {{ $user->email ?? '-' }}</li>
            </ul>
        </div>
    </div>
@endsection
