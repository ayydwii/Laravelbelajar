@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container py-5">
    <div class="post-detail-card mx-auto" style="max-width: 800px;">
        @if ($post->image)
            <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}">
        @endif

        <h2 class="fw-bold">{{ $post->title }}</h2>
        <p class="meta mb-3">Oleh {{ $post->user->name ?? 'Tidak diketahui' }} | {{ $post->created_at->format('d M Y') }}</p>

        <div class="mb-4" style="font-size: 15px; line-height: 1.6;">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Tombol aksi -->
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-secondary fw-bold">← Kembali</a>

            
        </div>
    </div>
</div>
@endsection
