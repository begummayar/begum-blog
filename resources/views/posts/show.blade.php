@extends('layouts.app')

@section('title', $post->title . ' | begum')

@section('content')
    <article class="article-detail">
        <a class="back-link" href="{{ route('home') }}">
            <span aria-hidden="true">←</span>
            Ana sayfaya dön
        </a>

        <header class="article-header">
            @if ($post->category)
                <p class="eyebrow article-category">
                    {{ $post->category }}
                </p>
            @endif

            <h1>{{ $post->title }}</h1>

            @if ($post->excerpt)
                <p class="article-excerpt">{{ $post->excerpt }}</p>
            @endif

            <div class="article-divider"></div>
        </header>

        <div class="article-content">{{ $post->content }}</div>

        <footer class="article-footer">
            <a class="button button-yellow" href="{{ route('home') }}">
                Diğer yazıları keşfet
            </a>
        </footer>
    </article>
@endsection
