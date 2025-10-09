@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Tambah Post')
@section('header-title', 'Halaman Tambah Post')

@section('content')
    <div class="card shadow-sm">

        <div class="card-body">
            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Tambah Post --}}
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Masukkan judul post" required>
                </div>

                {{-- Konten --}}
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" class="form-control" rows="5" placeholder="Tulis isi post..." required>{{ old('content') }}</textarea>
                </div>

                {{-- Upload Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- Tanggal Publish --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date') }}">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1">
                    <label for="is_featured" class="form-check-label">Tandai sebagai featured</label>
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
