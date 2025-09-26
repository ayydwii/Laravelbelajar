@extends('layouts.app')

@section('content')
<h2>Tambah Post</h2>

@if ($errors->any())
    <div style="background:#f8d7da; padding:10px; border-radius:5px; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <label>Judul</label><br>
    <input type="text" name="title" value="{{ old('title') }}"><br><br>

    <label>Konten</label><br>
    <textarea name="content">{{ old('content') }}</textarea><br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
