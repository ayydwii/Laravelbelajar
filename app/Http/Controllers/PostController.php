<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index() {
        // ambil data dari database
        $posts = Post::all();

        // kirim data ke view
        return view('posts.index', compact('posts'));
    }

    // menampilkan form create
    public function create() {
        return view('posts.create');
    }

    // simpan data baru
    public function store(Request $request) {
        Post::create($request->only(['title', 'content']));
        return redirect()->route('posts.index');
    }

    // tampilkan detail
    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    // tampilkan form edit
    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    // update data
    public function update(Request $request, Post $post) {
        $post->update($request->only(['title', 'content']));
        return redirect()->route('posts.index');
    }

    // hapus data
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
