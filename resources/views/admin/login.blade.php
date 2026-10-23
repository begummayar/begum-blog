@extends('layouts.app')

@section('title', 'Yönetici Girişi | begum')

@section('content')
    <section class="page-section">
        <div class="page-heading">
            <h1>Yönetici girişi</h1>
            <p>İçerik yönetimine devam etmek için giriş yap.</p>
        </div>

        <div class="form-card">
            @if ($errors->any())
                <div class="notice" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="username">
                        Kullanıcı adı
                    </label>

                    <input
                        class="form-control"
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >

                    @error('username')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        Şifre
                    </label>

                    <input
                        class="form-control"
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        required
                    >

                    @error('password')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions">
                    <button class="button button-yellow" type="submit">
                        Giriş Yap
                        <span aria-hidden="true">→</span>
                    </button>

                    <a class="button button-outline" href="{{ route('home') }}">
                        Ana sayfaya dön
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection
