<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ $post->title }}"><br>
            <textarea name="content">{{ $post->content }}</textarea><br>
            <button type="submit">Update</button>
        </form>
</body>
</html>
