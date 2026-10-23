<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Haberleri listele.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Yeni haber ekleme formu.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Yeni haber kaydet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'unique:posts,slug',
            ],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        $validated['is_published'] = true;

        Post::create($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Haber başarıyla eklendi.');
    }

    /**
     * Haber düzenleme formu.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Haberi güncelle.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
        ]);

        $post->update($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Haber başarıyla güncellendi.');
    }

    /**
     * Haberi sil.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Haber başarıyla silindi.');
    }
}
