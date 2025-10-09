<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class PostController extends Controller
{
    public function index()
{
    $posts = Post::with('user')->latest()->paginate(5);
    return view('posts.index', ['posts' => $posts]);
}

public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|min:3|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'publish_date' => 'nullable|date',
        'is_published' => 'boolean',
    ]);

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/posts'), $imageName);
        $validated['image'] = $imageName;
    }

    $validated['user_id'] = Auth::id();
    Post::create($validated);

    return redirect()->route('posts.index')
        ->with('success', 'Data berhasil ditambahkan!');
}

public function edit(Post $post)
{
    return view('posts.edit', ['post' => $post]);
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
    if ($post->image && File::exists(public_path('images/posts/' . $post->image))) {
        File::delete(public_path('images/posts/' . $post->image));
    }
    $post->delete();

    return redirect()->route('posts.index')
        ->with('success', 'Data berhasil dihapus!');
}

}
