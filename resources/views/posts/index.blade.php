
@extends('layouts.app')

@section('title', 'begum')

@section('content')
    @php
        $categories = $categories ?? collect();
        $category = $category ?? request()->query('kategori');
        $posts = $posts ?? collect();
    @endphp


    <section class="editorial-section">
        <div class="section-heading">
            <div>
                <p class="eyebrow">GÜNCEL YAYINLAR</p>
                <h2>Son yayınlar</h2>
            </div>

            @if (session('admin_logged_in'))
                <a class="nav-link nav-admin" href="{{ route('admin.posts.index') }}">
                    Haberleri Yönet
                </a>
            @endif
        </div>

        @if ($categories->isNotEmpty())
            <nav class="category-list" aria-label="Yazı kategorileri">
                <a
                    href="{{ route('home') }}"
                    class="category-link {{ empty($category) ? 'active' : '' }}"
                >
                    Tüm yazılar
                </a>

                @foreach ($categories as $item)
                    <a
                        href="{{ route('home', ['kategori' => $item]) }}"
                        class="category-link {{ $category === $item ? 'active' : '' }}"
                    >
                        {{ $item }}
                    </a>
                @endforeach
            </nav>
        @endif

        @if (session('success'))
            <div class="notice notice-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="post-grid">
            @forelse ($posts as $post)
                <article class="post-card">
                    <div class="post-card-top">
                        <span class="post-number">
                            {{ sprintf('%02d', $loop->iteration) }}
                        </span>

                        @if ($post->category)
                            <span class="post-category">
                                {{ $post->category }}
                            </span>
                        @endif
                    </div>

                    <div class="post-card-content">
                        <h3>{{ $post->title }}</h3>

                        @if ($post->excerpt)
                            <p>{{ $post->excerpt }}</p>
                        @endif

                        <a
                            class="read-more"
                            href="{{ route('posts.show', $post->slug) }}"
                        >
                            Devamını Oku
                            <span aria-hidden="true">↗</span>
                        </a>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <p class="eyebrow">YAYIN AKIŞI</p>

                    <h3>
                        {{ $category ? 'Bu kategoride henüz yazı yok.' : 'Henüz yayımlanmış bir yazı bulunmuyor.' }}
                    </h3>

                    <p>Yeni haberler ve makaleler yayımlandığında burada görünecek.</p>

                    @if ($category)
                        <a class="button button-yellow" href="{{ route('home') }}">
                            Tüm yazıları gör
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
    </section>
@endsection
