<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Yayınlanmış yazıları ve kategorileri ana sayfada gösterir.
     */
    public function index(Request $request)
    {
        $category = $request->query('kategori');

        $query = Post::where('is_published', true);

        if (!empty($category)) {
            $query->where('category', $category);
        }

        $posts = $query->latest()->get();

        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('posts.index', compact(
            'posts',
            'categories',
            'category'
        ));
    }

    /**
     * Yayınlanmış bir yazının detay sayfasını gösterir.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
