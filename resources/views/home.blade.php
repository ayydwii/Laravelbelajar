@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Dashboard')
@section('header-title', 'Dashboard')

@section('content')
    <div class="card p-4 shadow-sm">
        <h4>Selamat Datang, {{ $user->name ?? 'Admin' }}</h4>
        <p>I. Silakan pilih menu di sidebar untuk mengelola data.</p>

        <div class="mt-4">
            <h5>Ringkasan</h5>
            <ul>
                <li>Total User: {{ \App\Models\User::count() }}</li>
                <li>Email Login: {{ $user->email ?? '-' }}</li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
