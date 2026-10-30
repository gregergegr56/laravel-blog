<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    // Список всех статей — главная страница
    public function index(): View
    {
        $posts = Post::latest()->get();

        return view('posts.index', [
            'posts' => $posts,
            'favorites' => session('favorites', []),
        ]);
    }

    // Страница с формой добавления статьи
    public function create(): View
    {
        return view('posts.create');
    }

    // Приём данных POST-формы, валидация и сохранение статьи
    public function store(Request $request): RedirectResponse
    {
        // Валидация данных формы
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'body' => ['required', 'string', 'min:20'],
            'author' => ['nullable', 'string', 'max:50'],
        ], [
            'title.required' => 'Введите заголовок статьи.',
            'title.min' => 'Заголовок должен содержать не менее 5 символов.',
            'title.max' => 'Заголовок не может быть длиннее 100 символов.',
            'body.required' => 'Введите текст статьи.',
            'body.min' => 'Текст статьи должен содержать не менее 20 символов.',
            'author.max' => 'Имя автора не может быть длиннее 50 символов.',
        ]);

        // Если автор не указан, подставляем значение по умолчанию
        $validated['author'] = ($validated['author'] ?? null) ?: 'Аноним';

        // Сохраняем статью в базу данных
        $post = Post::create($validated);

        // Генерируем событие «статья опубликована»
        event(new PostCreated($post));

        // Flash-сообщение в сессию и редирект на главную
        return redirect()
            ->route('posts.index')
            ->with('success', 'Статья «'.$post->title.'» добавлена!');
    }

    // Просмотр одной статьи
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
            'favorites' => session('favorites', []),
        ]);
    }

    // Страница «Избранное» — список статей из сессии
    public function favorites(): View
    {
        $ids = session('favorites', []);
        $posts = Post::whereIn('id', $ids)->get();

        return view('posts.favorites', [
            'posts' => $posts,
            'favorites' => $ids,
        ]);
    }

    // Добавить/убрать статью из избранного (список храним в сессии)
    public function toggleFavorite(Request $request, Post $post): RedirectResponse
    {
        $favorites = session('favorites', []);

        if (in_array($post->id, $favorites)) {
            $favorites = array_values(array_diff($favorites, [$post->id]));
            $message = 'Статья удалена из избранного.';
        } else {
            $favorites[] = $post->id;
            $message = 'Статья добавлена в избранное.';
        }

        $request->session()->put('favorites', $favorites);

        return back()->with('success', $message);
    }
}
