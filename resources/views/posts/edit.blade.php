@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>

@if ($errors->any())
    <div style="background:#f8d7da; padding:10px; border-radius:5px; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Judul</label><br>
    <input type="text" name="title" value="{{ old('title', $post->title) }}"><br><br>

    <label>Konten</label><br>
    <textarea name="content">{{ old('content', $post->content) }}</textarea><br><br>

    <button type="submit">Update</button>
</form>
@endsection
