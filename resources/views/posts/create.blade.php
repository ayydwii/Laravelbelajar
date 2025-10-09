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
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
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
            'is_featured' => 'nullable|boolean',
        ]);

        // Checkbox
        $validated['is_featured'] = $request->has('is_featured');

        // Upload image
        if ($request->hasFile('image')) {
            if (!File::exists(public_path('images/posts'))) {
                File::makeDirectory(public_path('images/posts'), 0755, true);
            }
            $imageName = time() . '.' . $request->image->extension();
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
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:5',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Checkbox
        $validated['is_featured'] = $request->has('is_featured');

        // Upload image baru jika ada
        if ($request->hasFile('image')) {
            // Hapus file lama
            if ($post->image && File::exists(public_path('images/posts/' . $post->image))) {
                File::delete(public_path('images/posts/' . $post->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/posts'), $imageName);
            $validated['image'] = $imageName;
        }

        $post->update($validated);

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
