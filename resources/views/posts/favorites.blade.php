@extends('layout')

@section('title', 'Избранное — Блог на Laravel')

@section('content')
    <h1 style="margin-bottom: 18px;">Избранные статьи</h1>

    @if ($posts->isEmpty())
        <div class="card">Вы ещё не добавили статьи в избранное. Список хранится в сессии браузера.</div>
    @endif

    @foreach ($posts as $post)
        <div class="card">
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <div class="meta">Автор: {{ $post->author }} | {{ $post->created_at->format('d.m.Y H:i') }}</div>
            <div style="margin-top: 10px;">
                <form action="{{ route('posts.favorite', $post) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-small" style="background: #b7791f;">★ Убрать из избранного</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
