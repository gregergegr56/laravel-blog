@extends('layout')

@section('title', 'Статьи — Блог на Laravel')

@section('content')
    <h1 style="margin-bottom: 18px;">Последние статьи</h1>

    @if ($posts->isEmpty())
        <div class="card">Статей пока нет. <a href="{{ route('posts.create') }}">Добавить первую</a>!</div>
    @endif

    @foreach ($posts as $post)
        <div class="card">
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <div class="meta">Автор: {{ $post->author }} | {{ $post->created_at->format('d.m.Y H:i') }}</div>
            <p>{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>
            <div style="margin-top: 12px;">
                <a class="btn btn-small" href="{{ route('posts.show', $post) }}">Читать далее</a>

                <form action="{{ route('posts.favorite', $post) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-small" style="background: #b7791f;">
                        @if (in_array($post->id, $favorites))
                            ★ В избранном
                        @else
                            ☆ В избранное
                        @endif
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
