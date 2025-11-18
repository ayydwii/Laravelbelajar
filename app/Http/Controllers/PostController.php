<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        // Middleware hanya untuk method yang butuh login
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function publicIndex(Request $request)
    {
        $search = $request->input('search');

        $query = Post::with('user')->latest();

        // Kalau user belum login, hanya tampilkan post publish
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            $query->where('status', 'publish');
        }

        // Fitur pencarian
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->paginate(6);

        return view('posts.public-index', compact('posts'));
    }


    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mulai query dasar
        $query = Post::with('user');

        // Jika user biasa (bukan admin), hanya tampilkan post miliknya
        if (Auth::user()->role != 1) {
            $query->where('user_id', Auth::id());
        }

        // Jika ada pencarian
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // Urutkan terbaru dan paginasi
        $posts = $query->latest()->paginate(6);

        return view('posts.index', compact('posts', 'search'));
    }


    // == SHOW ==
    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // == CREATE ==
    public function create()
    {
        return view('posts.create');
    }

    // == STORE ==
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|in:publish,draft', // bisa kosong, nanti default draft
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        // Default status
        $validated['status'] = $request->status ?? 'draft';

        // Default tanggal jika kosong
        if (empty($validated['publish_date'])) {
            $validated['publish_date'] = now();
        }

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/posts'), $imageName);
            $validated['image'] = $imageName;
        }

        // Simpan user_id
        $validated['user_id'] = Auth::id();

        // Buat post baru dan assign ke $post
        $post = Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
    }


    // == EDIT ==
    public function edit(Post $post)
    {
        if (Auth::user()->role != 1 && Auth::id() !== $post->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit post ini.');
        }

        return view('posts.edit', compact('post'));
    }

    // == UPDATE ==
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Cek hak akses
        if (Auth::user()->role != 1 && Auth::id() !== $post->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit post ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|in:draft,publish', // Hanya draft atau publish
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Pastikan status selalu string yang valid
        $post->status = $validated['status'] ?? 'draft';
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        // Jika status publish dan publish_date belum ada
        if ($post->status === 'publish' && !$post->publish_date) {
            $post->publish_date = now();
        }

        // Upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && file_exists(public_path('images/posts/' . $post->image))) {
                unlink(public_path('images/posts/' . $post->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/posts'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }



    public function updateStatus(Request $request, $id)
    {

        $validated = $request->validate([
            'status' => 'required|in:draft,publish',
        ]);

        $post->status = $validated['status']; // ✅ HARUS string
        if ($post->status === 'publish' && !$post->publish_date) {
            $post->publish_date = now();
        }

        $post->save();

        return redirect()->back()->with('success', 'Status post berhasil diperbarui!');
    }





        // == DESTROY
        public function destroy(Post $post)
        {
            // Izinkan admin menghapus semua post
            if (Auth::user()->role != 1 && $post->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak punya izin untuk menghapus post ini.');
        }


            // Hapus file gambar jika ada
            if ($post->image && \Storage::exists('public/posts/' . $post->image)) {
                \Storage::delete('public/posts/' . $post->image);
            }

            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
        }

}
