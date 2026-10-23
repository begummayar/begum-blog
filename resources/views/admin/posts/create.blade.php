
@extends('layouts.app')

@section('title', 'Yeni Haber Ekle | begum')

@section('content')
    <section class="page-section">
        <div class="page-heading">
            <h1>Yeni haber oluştur</h1>
            <p>Yeni bir haber veya makale hazırlayıp yayınla.</p>
        </div>

        <div class="form-card">
            @if ($errors->any())
                <div class="notice" role="alert">
                    <strong>Formda bazı hatalar var:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.posts.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="title">Başlık *</label>

                    <input
                        class="form-control"
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        maxlength="255"
                        required
                    >

                    @error('title')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="slug">URL kısa adı *</label>

                    <input
                        class="form-control"
                        type="text"
                        id="slug"
                        name="slug"
                        value="{{ old('slug') }}"
                        maxlength="255"
                        pattern="[A-Za-z0-9_-]+"
                        placeholder="ornek-haber-basligi"
                        required
                    >

                    <p style="color: var(--muted); font-size: 12px;">
                        Türkçe karakter ve boşluk kullanma. Örnek: yeni-teknoloji-gelismeleri
                    </p>

                    @error('slug')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="category">Kategori</label>

                    <input
                        class="form-control"
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category') }}"
                        maxlength="255"
                        list="category-suggestions"
                        placeholder="Örn. Teknoloji, Bilim, Ekonomi"
                    >

                    <datalist id="category-suggestions">
                        <option value="Gündem">
                        <option value="Teknoloji">
                        <option value="Bilim">
                        <option value="Ekonomi">
                        <option value="Kültür">
                        <option value="Yaşam">
                        <option value="Analiz">
                    </datalist>

                    @error('category')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="excerpt">Kısa açıklama</label>

                    <textarea
                        class="form-control"
                        id="excerpt"
                        name="excerpt"
                        rows="3"
                        placeholder="Haberin ana fikrini kısaca anlat..."
                    >{{ old('excerpt') }}</textarea>

                    @error('excerpt')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="content">Haber / Makale içeriği *</label>

                    <textarea
                        class="form-control"
                        id="content"
                        name="content"
                        rows="12"
                        required
                        placeholder="Haberin veya makalenin tam içeriğini yaz..."
                    >{{ old('content') }}</textarea>

                    @error('content')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button class="button button-yellow" type="submit">
                        Haberi yayınla
                        <span aria-hidden="true">→</span>
                    </button>

                    <a class="button button-outline" href="{{ route('admin.posts.index') }}">
                        Vazgeç
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
