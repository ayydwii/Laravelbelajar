@extends('layouts.blog')

@section('title', 'Blog Publik')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Semua Post</h1>
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if ($post->image)
                    <img src="{{ asset('images/posts/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text text-muted">{{ $post->created_at->format('d M Y') }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Belum ada post yang dipublish.</p>
        @endforelse
    </div>
</div>
@endsection
