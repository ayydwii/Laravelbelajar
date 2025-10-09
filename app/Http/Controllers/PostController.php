<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        $posts = Post::with('user')
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(6);

        return view('posts.index', compact('posts', 'keyword'));
}


    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
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
        if ($post->user_id !== Auth::user()->is_admin) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit post ini');
        }

        $users = User::all;
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::user()->is_admin) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit post ini');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
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
        if ($post->user_id !== Auth::user()->is_admin) {
            abort(403, 'Kamu tidak memiliki akses untuk mengedit post ini');
        }

        if ($post->image && File::exists(public_path('images/posts/' . $post->image))) {
            File::delete(public_path('images/posts/' . $post->image));
        }
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
