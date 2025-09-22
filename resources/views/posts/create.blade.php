<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Post</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Judul"><br>
            <textarea name="content" placeholder="Isi konten"></textarea><br>
            <button type="submit">Simpan</button>
        </form>
</body>
</html>
