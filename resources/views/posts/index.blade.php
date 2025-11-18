@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Semua Post')
@section('header-title', 'Semua Post')

@section('content')
<div class="container py-5">

    <!-- Header: Tombol Tambah + Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('posts.create') }}" class="btn btn-primary fw-bold">
            + Tambah Post
        </a>

        <form action="{{ route('posts.index') }}" method="GET" class="d-flex gap-2" style="width: 250px;">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari post...">
            <button type="submit" class="btn btn-primary btn-sm fw-bold">Cari</button>
        </form>
    </div>

    <!-- Grid Post -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    @forelse ($posts as $post)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 post-card">
                @if ($post->image)
                    <img src="{{ asset('images/posts/' . $post->image) }}" class="card-img-top"
                        alt="{{ $post->title }}" style="height: 180px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-semibold">{{ Str::limit($post->title, 40) }}</h5>

                    {{-- Status Post --}}
                    <p class="mb-1">
                        <span class="text-muted" style="font-size: 0.8rem;">Status:</span>
                        @if ($post->status === 'publish')
                            <span class="badge bg-success">Publish</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </p>

                    <p class="text-muted mb-2" style="font-size: 0.75rem;">Oleh {{ $post->user->name ?? 'Tidak diketahui' }}</p>

                    <p class="card-text flex-grow-1">{{ Str::limit($post->content, 80) }}</p>

                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary w-100 mt-auto mb-2">
                        Lihat Detail
                    </a>

                    @if (auth()->user()->role === 1 || $post->user_id === auth()->id())
                        <div class="d-flex gap-2">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm flex-grow-1">Edit</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Yakin ingin menghapus post ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Tidak ada post ditemukan.</p>
        </div>
    @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>

</div>
@endsection
