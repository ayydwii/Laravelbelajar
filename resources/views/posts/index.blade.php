@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Semua Post')
@section('header-title', 'Semua Post')

@section('content')
<div class="container py-5">

    <!-- Header: Tombol Tambah + Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <a href="{{ route('posts.create') }}" class="btn btn-success">
            + Tambah Post
        </a>

        <form action="{{ route('posts.index') }}" method="GET" class="d-flex" style="width: 250px; gap: 8px;">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control form-control-sm"
                placeholder="Cari post...">
            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
        </form>
    </div>

    <!-- Grid Post -->
    <div class="row g-4">
        @forelse ($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($post->image)
                        <img src="{{ asset('images/posts/' . $post->image) }}"
                                class="card-img-top"
                                alt="{{ $post->title }}"
                                style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="text-muted mb-1">Oleh {{ $post->user->name ?? 'Tidak diketahui' }}</p>
                        <p class="card-text text-secondary" style="font-size: 14px;">
                            {{ Str::limit($post->content, 80) }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-3 px-3">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Tidak ada post ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
