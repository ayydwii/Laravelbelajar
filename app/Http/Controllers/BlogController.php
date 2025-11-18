<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Halaman publik (bisa diakses siapa saja)
     */
    public function index()
    {
        // Ambil semua post yang status-nya publish, urut terbaru dulu
        $posts = Post::where('status', 'publish')->latest()->get();

        return view('public/posts.index', compact('posts'));
    }



    public function public()
    {
        // Ambil semua post yang sudah publish
        $posts = \App\Models\Post::with('user')
            ->where('status', 'publish')
            ->latest()
            ->get();

        return view('blogs.public', compact('posts'));
    }


    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);

        // Jika status-nya draft, jangan tampilkan ke publik
        if ($post->status === 'draft' && (!auth()->check() || auth()->user()->role !== 'admin')) {
            abort(403, 'Post ini belum dipublikasikan.');
        }

        return view('blogs.show', compact('post'));
    }


}
