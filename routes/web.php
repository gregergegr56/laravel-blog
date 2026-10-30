<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Главная страница — список статей
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Страница «О проекте»
Route::get('/about', [PageController::class, 'about'])->name('about');

// Избранное (хранится в сессии)
Route::get('/favorites', [PostController::class, 'favorites'])->name('posts.favorites');

// Работа со статьями
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/favorite', [PostController::class, 'toggleFavorite'])->name('posts.favorite');
