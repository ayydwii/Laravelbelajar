<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Post</title>
</head>
<body>
    <h1>Daftar Post</h1>

    <a href="{{ route('posts.create') }}">Tambah Post</a>

        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Aksi</th>
            </tr>

        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <a href="{{ route('posts.show', $post->id) }}">Lihat</a> |
                    <a href="{{ route('posts.edit', $post->id) }}">Edit</a> |
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
</table>

</body>
</html>
