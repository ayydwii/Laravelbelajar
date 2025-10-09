@extends('layouts.app')

@push('styles')
@endpush

@section('title', 'Halaman Post')
@section('header-title', 'Halaman Post')

@section('content')

@if ($message = Session::get('success'))
    <div style="background:#d1e7dd; padding:10px; margin-bottom:10px; border-radius:5px;">
        {{ $message }}
    </div>
@endif

<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
    <i class="bi bi-plus-lg"></i> Tambah Post
</a>



<table border="1" cellpadding="10" cellspacing="0" style="margin-top:10px; width:100%;">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Konten</th>
        <th>Aksi</th>
    </tr>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ Str::limit($post->content, 50) }}</td>
        <td>
            <a href="{{ route('posts.edit', $post->id) }}">Edit</a> |
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<div style="margin-top:10px;">
    {{ $posts->links() }}
</div>
@endsection
