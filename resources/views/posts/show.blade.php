@extends('layout')

@section('title', $post->title.' — Блог на Laravel')

@section('content')
    <div class="card">
        <h1>{{ $post->title }}</h1>
        <div class="meta">Автор: {{ $post->author }} | {{ $post->created_at->format('d.m.Y H:i') }}</div>

        <p style="white-space: pre-line; margin-top: 12px;">{{ $post->body }}</p>

        <div style="margin-top: 18px;">
            <a class="btn btn-small" href="{{ route('posts.index') }}">← Ко всем статьям</a>

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
@endsection
