<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // =======================
    //  INDEX
    // =======================
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Kalau admin → lihat semua post
        if (Auth::user()->role == 1) {
            $posts = Post::with('user')
                ->when($search, function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10);
        } else {
            // Kalau user biasa → hanya lihat post miliknya
            $posts = Post::with('user')
                ->where('user_id', Auth::id())
                ->when($search, function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10);
        }

        return view('posts.index', compact('posts', 'search'));
    }

    // =======================
    //  SHOW
    // =======================
    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // =======================
    //  CREATE
    // =======================
    public function create()
    {
        return view('posts.create');
    }

    // =======================
    //  STORE
    // =======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

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

        return redirect()->route('posts.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // =======================
    //  EDIT
    // =======================
    public function edit(Post $post)
    {
        if (Auth::user()->role != 1 && Auth::id() !== $post->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit post ini.');
        }

        return view('posts.edit', compact('post'));
    }

    // =======================
    //  UPDATE
    // =======================
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->role != 1 && Auth::id() !== $post->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengupdate post ini.');
        }

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:5',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($post->image && File::exists(public_path('images/posts/' . $post->image))) {
                File::delete(public_path('images/posts/' . $post->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/posts'), $imageName);
            $validated['image'] = $imageName;
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Data berhasil diupdate!');
    }

    // =======================
    //  DESTROY
    // =======================
    public function destroy(Post $post)
    {
        if (Auth::user()->role != 1 && Auth::id() !== $post->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk menghapus post ini.');
        }

        if ($post->image && File::exists(public_path('images/posts/' . $post->image))) {
            File::delete(public_path('images/posts/' . $post->image));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Data berhasil dihapus!');
    }
}
