
@extends('layouts.app')

@section('title', 'Haberleri Yönet | begum')

@section('content')
    <section class="page-section" style="max-width: 100%;">
        <div class="page-heading">
            <h1>Haberleri yönet</h1>
            <p>Yayınlarını buradan ekleyebilir, düzenleyebilir ve silebilirsin.</p>
        </div>

        @if (session('success'))
            <div class="notice notice-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="notice" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 24px;">
            <p style="margin: 0; color: var(--muted); font-size: 13px;">
                Toplam {{ $posts->total() }} haber
            </p>

            <a class="button button-yellow" href="{{ route('admin.posts.create') }}">
                + Yeni haber ekle
            </a>
        </div>

        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Yayın durumu</th>
                    <th>İşlemler</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            <br>
                            <span style="color: var(--muted);">
                                    /haber/{{ $post->slug }}
                                </span>
                        </td>

                        <td>{{ $post->category ?: 'Kategorisiz' }}</td>

                        <td>
                            @if ($post->is_published)
                                <span>Yayında</span>
                            @else
                                <span>Taslak</span>
                            @endif
                        </td>

                        <td>
                            <div class="table-actions">
                                <a
                                    class="text-link"
                                    href="{{ route('admin.posts.edit', $post) }}"
                                >
                                    Düzenle
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.posts.destroy', $post) }}"
                                    onsubmit="return confirm('Bu haberi silmek istediğine emin misin?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="text-link text-danger"
                                        type="submit"
                                        style="border: 0; background: transparent; padding: 0;"
                                    >
                                        Sil
                                    </button>
                                </form>

                                @if ($post->is_published)
                                    <a
                                        class="text-link"
                                        href="{{ route('posts.show', $post->slug) }}"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        Görüntüle
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px 20px;">
                            Henüz haber eklenmemiş.
                            <br><br>
                            <a class="button button-yellow" href="{{ route('admin.posts.create') }}">
                                İlk haberi ekle
                            </a>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($posts->hasPages())
            <div style="margin-top: 24px;">
                {{ $posts->links() }}
            </div>
        @endif

        <div style="margin-top: 28px;">
            <a class="button button-outline" href="{{ route('home') }}">
                ← Siteye dön
            </a>
        </div>
    </section>
@endsection
