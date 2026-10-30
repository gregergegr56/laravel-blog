@extends('layout')

@section('title', 'Новая статья — Блог на Laravel')

@section('content')
    <h1 style="margin-bottom: 18px;">Добавить статью</h1>

    <div class="card">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Например: Мой первый пост">
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="author">Автор (необязательно):</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="Имя автора">
            @error('author')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="body">Текст статьи:</label>
            <textarea id="body" name="body" placeholder="Текст статьи (минимум 20 символов)">{{ old('body') }}</textarea>
            @error('body')
                <div class="error">{{ $message }}</div>
            @enderror

            <p style="margin-top: 16px;">
                <button type="submit" class="btn">Опубликовать</button>
            </p>
        </form>
    </div>
@endsection
