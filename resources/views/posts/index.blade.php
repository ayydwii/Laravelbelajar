@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4 fw-bold">Semua Post</h2>

    <!-- 🔍 Form Pencarian -->
    <form action="{{ route('posts.index') }}" method="GET" class="d-flex justify-content-center mb-5">
        <input
            type="text"
            name="search"
            class="form-control w-50 shadow-sm me-2"
            placeholder="Cari judul atau isi post..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary px-4">Cari</button>
    </form>

    <!-- 📚 Grid Post -->
    @if ($posts->count() > 0)
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        @if ($post->image)
                            <img src="{{ asset('images/posts/' . $post->image) }}"
                                 class="card-img-top"
                                 alt="{{ $post->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                            <small class="text-secondary d-block mb-2">
                                🖋️ {{ $post->user->name ?? 'Tidak diketahui' }}
                            </small>
                            <a href="#" class="btn btn-outline-primary btn-sm">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 🔗 Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $posts->appends(['search' => request('search')])->links() }}
        </div>

    @else
        <div class="text-center text-muted fs-5">
            Tidak ada post ditemukan.
        </div>
    @endif
</div>
@endsection
