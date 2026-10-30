@extends('layout')

@section('title', 'О проекте — Блог на Laravel')

@section('content')
    <h1 style="margin-bottom: 18px;">О проекте</h1>

    <div class="card">
        <p>В проекте демонстрируются:</p>
        <ul style="margin: 10px 0 0 22px; line-height: 1.7;">
            <li>роутинг, контроллеры и шаблоны Blade;</li>
            <li>модели Eloquent и миграции;</li>
            <li>приём и валидация данных POST-форм;</li>
            <li>работа с сессиями;</li>
            <li>события и слушатели.</li>
        </ul>

        <p style="margin-top: 15px;"><strong>Вы посетили эту страницу {{ $visits }} раз(а).</strong>
            Счётчик хранится в сессии.</p>
    </div>
@endsection
