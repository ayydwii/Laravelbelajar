@extends('layouts.app')

@section('title', 'Detail Post')
@section('header-title', 'Detail Post')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p class="text-muted">
                Oleh <strong>{{ $post->user->name ?? 'Tidak diketahui' }}</strong>
                | Dipublikasikan pada {{ \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y') }}
            </p>
            <hr>
            <p class="fs-5">{{ $post->content }}</p>

            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-4">
                ← Kembali ke daftar post
            </a>
        </div>
    </div>
</div>
@endsection
