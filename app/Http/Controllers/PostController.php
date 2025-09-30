<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
{
    $posts = Post::latest()->paginate(5); // menampilkan 5 data per halaman
    return view('posts.index', compact('posts'));
}

public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|min:3|max:100',
        'content' => 'required|min:5',
    ]);

    Post::create($request->all());

    return redirect()->route('posts.index')
        ->with('success', 'Data berhasil ditambahkan!');
}

public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|min:3|max:100',
        'content' => 'required|min:5',
    ]);

    $post->update($request->all());

    return redirect()->route('posts.index')
        ->with('success', 'Data berhasil diupdate!');
}

public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index')
        ->with('success', 'Data berhasil dihapus!');
}

}
