<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Блог на Laravel')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #333; }
        header { background: #35495e; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; margin-right: 18px; font-size: 16px; }
        header a:hover { text-decoration: underline; }
        header .brand { font-size: 20px; font-weight: bold; margin-right: 40px; }
        main { max-width: 850px; margin: 30px auto; padding: 0 15px; }
        .card { background: #fff; border-radius: 6px; padding: 20px; margin-bottom: 18px; box-shadow: 0 1px 3px rgba(0,0,0,.15); }
        .card h2 a { color: #35495e; text-decoration: none; }
        .card h2 a:hover { text-decoration: underline; }
        .meta { color: #888; font-size: 13px; margin-bottom: 10px; }
        .btn { display: inline-block; background: #35495e; color: #fff; padding: 9px 18px; border: none; border-radius: 4px; font-size: 15px; cursor: pointer; text-decoration: none; }
        .btn:hover { background: #2a3a4d; }
        .btn-small { padding: 5px 12px; font-size: 13px; }
        label { display: block; margin: 12px 0 5px; font-weight: bold; }
        input[type=text], textarea { width: 100%; padding: 9px; border: 1px solid #bbb; border-radius: 4px; font-size: 15px; font-family: Arial; }
        textarea { min-height: 160px; }
        .error { color: #c0392b; font-size: 13px; margin-top: 4px; }
        .alert { padding: 12px 15px; border-radius: 5px; margin-bottom: 18px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        footer { text-align: center; color: #999; font-size: 13px; margin: 40px 0 20px; }
    </style>
</head>
<body>
    <header>
        <div>
            <a href="{{ route('posts.index') }}" class="brand">Блог на Laravel</a>
            <a href="{{ route('posts.index') }}">Статьи</a>
            <a href="{{ route('posts.favorites') }}">Избранное</a>
            <a href="{{ route('about') }}">О проекте</a>
        </div>
        <a href="{{ route('posts.create') }}">+ Добавить статью</a>
    </header>

    <main>
        {{-- Flash-сообщения из сессии --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('event'))
            <div class="alert alert-info">{{ session('event') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>При отправке формы возникли ошибки:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
