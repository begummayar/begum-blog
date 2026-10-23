<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

// Herkese açık ana sayfa
Route::get('/', [PostController::class, 'index'])
    ->name('home');

// Herkese açık yazı detay sayfası
Route::get('/haber/{slug}', [PostController::class, 'show'])
    ->name('posts.show');

// Yönetici giriş ve çıkış işlemleri
Route::get('/admin/giris', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/giris', [AuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/cikis', [AuthController::class, 'logout'])
    ->name('admin.logout');

// Yalnızca giriş yapmış yönetici erişebilir
Route::middleware('admin.auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Yazıları listele
        Route::get('/haberler', [AdminPostController::class, 'index'])
            ->name('posts.index');

        // Yeni yazı ekle
        Route::get('/haber-ekle', [AdminPostController::class, 'create'])
            ->name('posts.create');

        Route::post('/haber-ekle', [AdminPostController::class, 'store'])
            ->name('posts.store');

        // Yazı düzenle
        Route::get('/haber-duzenle/{post}', [AdminPostController::class, 'edit'])
            ->name('posts.edit');

        Route::put('/haber-duzenle/{post}', [AdminPostController::class, 'update'])
            ->name('posts.update');

        // Yazı sil
        Route::delete('/haber-sil/{post}', [AdminPostController::class, 'destroy'])
            ->name('posts.destroy');
    });
