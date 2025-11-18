@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container py-4">
    @if (!$post)
        <div class="alert alert-warning text-center">Post tidak ditemukan.</div>
    @else
        <div class="edit-post-card">
            <h2>Edit Post</h2>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form utama edit post -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                </div>

                <!-- Konten -->
                <div class="mb-3">
                    <label for="content" class="form-label fw-semibold">Konten</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Status & Tombol Cepat -->
                <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
                    <label for="status" class="form-label fw-semibold mb-0 me-2">Status Post:</label>

                    <!-- Form utama select status -->
                    <select name="status" id="status" class="form-select w-auto" required>
                        <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>

                    <!-- Tombol cepat Publish/Draft (form terpisah tapi inline) -->
                    <form action="{{ route('posts.updateStatus', $post->id) }}" method="POST" class="d-inline ms-2">
                        @csrf
                        @method('PATCH')
                        @if ($post->status == 'draft')
                            <input type="hidden" name="status" value="publish">
                            <button type="submit" class="btn btn-success fw-bold">Publish Sekarang</button>
                        @else
                            <input type="hidden" name="status" value="draft">
                            <button class="btn btn-warning fw-bold">Set ke Draft</button>
                        @endif
                    </form>
                </div>


                <!-- Gambar -->
                <div class="mb-3">
                    <label for="image" class="form-label fw-semibold">Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control">
                    @if ($post->image)
                        <img src="{{ asset('images/posts/' . $post->image) }}" class="mt-2 w-100">
                    @endif
                </div>

                <!-- Tombol Simpan Perubahan -->
                <div class="d-flex justify-content-between flex-wrap gap-2 mt-3">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary fw-bold">← Kembali</a>
                    <button type="submit" class="btn btn-primary fw-bold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
